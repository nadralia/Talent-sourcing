<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Requests\talent\UpdateEducationRequest;
use App\Http\Resources\EducationResource;
use App\Services\TalentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EducationController
{
    protected $cache_duration;
    protected $talentService;

    public function __construct()
    {
        $this->cache_duration = now()->addDays(config('resume.cache_days'))->endOfDay();

        $this->educations_data_cache_key = config('resume.educations_data_cache_key') . auth('talent')->id();

        $this->talentService = auth('talent')->check() ? new TalentService(auth('talent')->user()) : null;
    }

    /**
     * Return list of talents
     *
     *
     * @return \App\Http\Resources\EducationCollection
     */
    public function index()
    {
        return successResponse(
            collect(
                EducationResource::collection(
                    auth('talent')->user()->educations->sortByDesc('start_date')
                )
            )->merge(
                collect(auth('talent')->user()->getCachedEducationData())
            )
        );
    }

    /**
     * Update the specified talent in storage.
     *
     * @param UpdateEducationRequest $request     HTTP request
     * @para int                    $education_id Primary key of education of interest
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEducationRequest $request, int $education_id = null)
    {
        $response = errorResponse('Unable to update entry!', 400);

        try {
            $education = auth('talent')->user()->educations()->whereId($education_id)->firstOrFail();

            $education->update($request->validated());

            $response = successResponse($education);
        } catch (ModelNotFoundException $exception) {
            $response = errorResponse('Record not found!', 404);
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }

    /**
     * Remove the specified talent from storage.
     *
     * @param int $id Primary key of talent of interest
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $education_id) : JsonResponse
    {
        if ($found_education = auth('talent')->user()->educations()->whereId($education_id)->first()) {
            try {
                $found_education->forceDelete();
            } catch (Throwable $exception) {
                $found_education->delete();
            }

            return successResponse();
        }

        if ($education_id == 0
            && $request->filled('key')
            && $this->talentService->deleteCachedResumeData($request->key, 'educations')
        ) {

            return successResponse();
        }
        
        return errorResponse('Entry not found!', 404);
    }

    /**
     * Store a newly created talent in storage.
     *
     * @param UpdateEducationRequest $request HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateEducationRequest $request)
    {
        $response = errorResponse('Unable to create new entrty!', 500);

        try {
            if ($request->filled('key')) {
                $this->talentService->deleteCachedResumeData($request->key, 'educations');
            }

            if ($new_record = auth('talent')->user()->educations()->create($request->validated())) {

                $response = successResponse($new_record);
            }
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }
}
