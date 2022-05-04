<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Services\TalentService;
use App\Http\Resources\TalentSkillResource;
use App\Http\Requests\talent\AddTalentSkillRequest;
use App\Http\Requests\talent\UpdateTalentSkillRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TalentSkillController
{
    protected $page_size;
    protected $max_primary_skills;
    protected $max_secondary_skills;

    protected $talentService;

    public function __construct()
    {
        $this->page_size            = config('app.default_pagination_size');
        $this->max_primary_skills   = config('resume.max_primary_skills');
        $this->max_secondary_skills = config('resume.max_secondary_skills');

        $this->talentService = auth('talent')->check() ? new TalentService(auth('talent')->user()) : null;
    }

    /**
     * Return list of the authenticated talent's skills
     *
     *
     * @return \App\Http\Resources\TalentSkillResource
     */
    public function index()
    {
        return successResponse(
            collect(
                TalentSkillResource::collection(
                    auth('talent')->user()->skills
                )
            )->merge(
                collect(auth('talent')->user()->getCachedSkillsData())
            )
        );
    }

    /**
     * Update the specified talent's skill in storage.
     *
     * @param UpdateTalentSkillRequest $request HTTP request
     * @para int                       $skill_id Primary key of skill of interest
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTalentSkillRequest $request, int $skill_id)
    {
        $response = errorResponse('Unable to update entry!', 400);

        try {
            DB::beginTransaction();

            $record = auth('talent')->user()->skills()->whereId($skill_id)->firstOrFail();

            $record->update($request->validated());

            if (auth('talent')->user()->primarySkillsCount > $this->max_primary_skills) {
                DB::rollBack();
                return errorResponse('You have reached the maximum number of Primar Skills allowed!', 400);
            } elseif (auth('talent')->user()->secondarySkillsCount > $this->max_secondary_skills) {
                DB::rollBack();
                return errorResponse('You have reached the maximum number of Secondary Skills allowed!', 400);
            }

            DB::commit();

            $response = successResponse($record->refresh());
        } catch (ModelNotFoundException $exception) {
            $response = errorResponse('Record not found!', 404);
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }

    /**
     * Delete the specified talent's skill
     *
     * @param int $skill_id Primary key of skill of interest
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $skill_id) : JsonResponse
    {
        if ($found_skill = auth('talent')->user()->skills()->whereId($skill_id)->first()) {
            try {
                $found_skill->forceDelete();
            } catch (Throwable $exception) {
                $found_skill->delete();
            }

            return successResponse();
        }

        if ($skill_id == 0
            && $request->has('key')
            && $this->talentService->deleteCachedResumeData($request->key, 'skills')
        ) {

            return successResponse();
        }
        
        return errorResponse('Entry not found!', 404);
    }

    /**
     * Add a new skill for the authenticated talent.
     *
     * @param AddTalentSkillRequest $request HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddTalentSkillRequest $request)
    {
        $response = errorResponse('Unable to create new entrty!', 500);

        try {
            DB::beginTransaction();

            $added_skill = auth('talent')->user()->skills()->create($request->validated());

            if (auth('talent')->user()->primarySkillsCount > $this->max_primary_skills) {
                DB::rollBack();
                return errorResponse('You have reached the maximum number of Primary Skills allowed!', 400);
            } elseif (auth('talent')->user()->secondarySkillsCount > $this->max_secondary_skills) {
                DB::rollBack();
                return errorResponse('You have reached the maximum number of Secondary Skills allowed!', 400);
            }

            if ($request->filled('key')) {
                $this->talentService->deleteCachedResumeData($request->key, 'skills');
            }

            DB::commit();

            $response = successResponse($added_skill);
        } catch (Throwable $exception) {
            if (is_numeric(strpos($exception->getMessage(), 'Duplicate entry'))) {
                $response = errorResponse('The skill already exists for this talent!', 409);
            }

            Log::error($exception);
        }

        return $response;
    }
}
