<?php

namespace App\Http\Controllers\api\v1\talent;

use App\Events\TalentUpdated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Requests\talent\AddTalentLanguageRequest;
use App\Http\Requests\talent\TalentCultureFitRequest;
use Illuminate\Support\Facades\DB;
use App\Services\TalentService;
use App\Models\CultureFitCategory;

class TalentCultureFitController
{
    protected $talentService;

    public function __construct()
    {
        $this->talentService = auth('talent')->check() ? new TalentService(auth('talent')->user()) : null;
    }

    /**
     * Return selected culture fit items for the authenticated talent
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : JsonResponse
    {
        $talent_choices  = [];
        $category_limits = CultureFitCategory::pluck('max_choices', 'id')->toArray();

        foreach (auth('talent')->user()->cultureFitCategoryChoices() as $category_id => $choices) {
            $talent_choices = array_merge(
                $talent_choices,
                collect(array_map('intval', explode(',', $choices)))->take($category_limits[$category_id])->toArray()
            );
        }

        return successResponse($talent_choices);
    }

    /**
     * Update the selected culture fit items for the authenticated talent
     *
     * @param \App\Http\Requests\talent\TalentCultureFitRequest $request HTTP request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TalentCultureFitRequest $request)
    {
        $response = errorResponse('Unable to update record!', 400);

        try {
            DB::beginTransaction();

            auth('talent')->user()->cultureFit()->sync($request->data);

            $invalid_selections = auth('talent')->user()->cultureFit()->groupBy('category_id')
                ->selectRaw('category_id, count(culture_fit_id) AS count')
                ->pluck('count', 'category_id')
                ->filter(function ($item) {return $item > config('app.max_culture_fit');})->toArray();
            
            if ($invalid_selections) {
                $response = errorResponse('Selection is above the limit', 400);

                DB::rollBack();
            } else {
                event(new TalentUpdated(auth('talent')->user()));

                DB::commit();
            }

            $response = successResponse(auth('talent')->user()->cultureFit->pluck('id'));
        } catch (Throwable $exception) {
            Log::error($exception);

            DB::rollBack();
        }

        return $response;
    }

    /**
     * Remove the specified language for the authenticated talent
     *
     * @param int $language_id Primary key of language of interest
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $language_id) : JsonResponse
    {
        if ($found_record = auth('talent')->user()->languages()->whereId($language_id)->first()) {
            
            try {
                $found_record->forceDelete();
            } catch (Throwable $exception) {
                $found_record->delete();
            }

            event(new TalentUpdated(auth('talent')->user()));

            return successResponse();
        }
        
        return errorResponse('Entry not found!', 404);
    }

    /**
     * Add new language for the authenticated talent
     *
     * @param AddTalentLanguageRequest $request HTTP request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(AddTalentLanguageRequest $request)
    {
        $response = errorResponse('Unable to create new entrty!', 500);

        try {
            $response = successResponse(auth('talent')->user()->languages()->create($request->validated()));
        } catch (Throwable $exception) {
            if (is_numeric(strpos($exception->getMessage(), 'Duplicate entry'))) {
                $response = errorResponse('The language already exists for this talent!', 400);
            }

            Log::error($exception);
        }

        event(new TalentUpdated(auth('talent')->user()));

        return $response;
    }
}
