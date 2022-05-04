<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Requests\talent\UpdateExperienceRequest;
use App\Http\Resources\ExperienceCollection;
use App\Http\Requests\talent\AddExperienceRequest;
use App\Http\Resources\ExperienceResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Services\TalentService;

class ExperienceController
{
    protected $page_size;
    protected $talentService;

    public function __construct()
    {
        $this->page_size = config('app.default_pagination_size');
        
        $this->talentService = auth('talent')->check() ? new TalentService(auth('talent')->user()) : null;
    }

    /**
     * Return list of the authenticated talent's experiences
     *
     *
     * @return \App\Http\Resources\ExperienceCollection
     */
    public function index()
    {
        return successResponse(
            collect(
                ExperienceResource::collection(
                    auth('talent')->user()->experiences->sortByDesc('start_date')
                )
            )->merge(
                collect(auth('talent')->user()->getCachedExperiencesData())
            )
        );
    }

    /**
     * Update the specified talent in storage.
     *
     * @param UpdateExperienceRequest $request     HTTP request
     * @para int                    $experience_id Primary key of experience of interest
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperienceRequest $request, int $experience_id)
    {
        $response = errorResponse('Unable to update record!', 400);

        try {
            $record = auth('talent')->user()->experiences()->whereId($experience_id)->firstOrFail();

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
     * Delete the specified talent's experience
     *
     * @param int $experience_id Primary key of experience of interest
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $experience_id) : JsonResponse
    {
        if ($found_experience = auth('talent')->user()->experiences()->whereId($experience_id)->first()) {
            try {
                $found_experience->forceDelete();
            } catch (Throwable $exception) {
                $found_experience->delete();
            }

            return successResponse();
        }

        if ($experience_id == 0
            && $request->has('key')
            && $this->talentService->deleteCachedResumeData($request->key, 'experiences')
        ) {

            return successResponse();
        }
        
        return errorResponse('Entry not found!', 404);
    }

    /**
     * Store a newly created work experience for the authenticated talent.
     *
     * @param AddExperienceRequest $request HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddExperienceRequest $request)
    {
        $response = errorResponse('Unable to create new entrty!', 500);

        try {
            if ($request->filled('key')) {
                $this->talentService->deleteCachedResumeData($request->key, 'experiences');
            }

            if ($new_record = auth('talent')->user()->experiences()->create($request->validated())) {

                $response = successResponse($new_record);
            }
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }
}
