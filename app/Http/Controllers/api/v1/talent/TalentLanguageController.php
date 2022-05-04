<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Resources\TalentLanguageResource;
use App\Http\Requests\talent\AddTalentLanguageRequest;
use App\Http\Requests\talent\UpdateTalentLanguageRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\TalentService;

class TalentLanguageController
{
    protected $talentService;

    public function __construct()
    {
        $this->talentService = auth('talent')->check() ? new TalentService(auth('talent')->user()) : null;
    }

    /**
     * Return list of languages for the authenticated talent
     *
     *
     * @return \App\Http\Resources\LanguageResource
     */
    public function index()
    {
        return successResponse(TalentLanguageResource::collection(auth('talent')->user()->languages));
    }

    /**
     * Update the specified language for the authenticated talent
     *
     * @param UpdateTalentLanguageRequest $request     HTTP request
     * @para int                          $language_id Primary key of language of interest
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTalentLanguageRequest $request, int $language_id)
    {
        $response = errorResponse('Unable to update record!', 400);

        try {
            $record = auth('talent')->user()->languages()->whereId($language_id)->firstOrFail();

            $record->update($request->validated());

            $response = successResponse($record->refresh());
        } catch (ModelNotFoundException $exception) {
            $response = errorResponse('Record not found!', 404);
        } catch (Throwable $exception) {
            Log::error($exception);
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
                $response = errorResponse('The language already exists for this talent!', 409);
            }

            Log::error($exception);
        }

        return $response;
    }
}
