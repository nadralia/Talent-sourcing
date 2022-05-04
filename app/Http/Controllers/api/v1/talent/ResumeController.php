<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Resources\ResumeResource;
use App\Http\Requests\talent\UploadResumeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\talent\UpdateResumeRequest;
use App\Services\TalentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResumeController
{
    protected $talentService;

    public function __construct()
    {
        $this->talentService = auth('talent')->check() ? new TalentService(auth('talent')->user()) : null;
    }
    /**
     * Return list of resumees
     *
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return successResponse(
            ResumeResource::collection(
                auth('talent')->user()->resumes()->latest('updated_at')->take(1)->get()
                )
        );
    }

    /**
     * Return a resume record
     *
     * @param Reqest $request   HTTP request
     * @param int    $resume_id Primary key of resume of interest
     * 
     *
     * @return \App\Http\Resources\EducationCollection
     */
    public function show(Request $request, int $resume_id)
    {
        $resume = auth('talent')->user()->resumes()->whereId($resume_id)->first();

        if ($request->file == 'true') {
            return Storage::get("resumes/$resume->file_name");
        }
    
        return successResponse(new ResumeResource($resume));
    }

    /**
     * Update the specified resume for the authenticated talent.
     *
     * @param UpdateResumeRequest $request   HTTP request
     * @para int                  $resume_id Primary key of resume of interest
     * 
     * 
     * @return JsonResponse
     */
    public function update(UpdateResumeRequest $request, int $resume_id)
    {
        $response = errorResponse('Unable to update record!', 400);

        try {
            $record = auth('talent')->user()->resumes()->whereId($resume_id)->firstOrFail();

            $record->update($request->validated());

            $this->talentService->parseResume(null, false);

            $response = successResponse($record->refresh());
        } catch (ModelNotFoundException $exception) {
            $response = errorResponse('Record not found!', 404);
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }

    /**
     * Delete the specified resume for the authenticated talent.
     *
     * @param int $resume_id Primary key of resume of interest
     * 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $resume_id) : JsonResponse
    {
        if ($found_record = auth('talent')->user()->resumes()->whereId($resume_id)->first()) {
            
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
     * Upload a new resume for the authenticated talent
     *
     * @param UploadResumeRequest $request HTTP request
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(UploadResumeRequest $request)
    {
        $response = errorResponse('Unable to create new entrty!', 500);

        try {
            if ($file = $request->validated()['file'] ?? null) {
                $file_name = md5($file->get()) . '.' . $file->extension();

                $request->file('file')->storeAs('resumes', $file_name);

                auth('talent')->user()->resumes()->updateOrCreate(
                    [ 'file_name' => $request->name ?? $file_name ],
                    [ 'name' => $request->validated()['name'] ?? $file->getClientOriginalName() ]
                );

                $this->talentService->parseResume(null, false);

                $response = successResponse();
            }
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }
}
