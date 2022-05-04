<?php

namespace App\Http\Controllers\api\v1\talent;

use App\Models\Talent;
use App\Http\Resources\TalentResource;
use App\Services\TalentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Requests\StoreTalentFormRequest;
use App\Http\Resources\TalentCollection;
use App\Http\Requests\talent\UpdateTalentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class TalentController
{
    protected $page_size;
    protected $talentService;

    public function __construct()
    {
        $this->page_size     = config('app.default_pagination_size');
        $this->talentService = auth('talent')->check() ? new TalentService(auth('talent')->user()) : null;

        $this->talent_data_cache_key = config('resume.talent_data_cache_prefix') . auth('talent')->id();
    }

    /**
     * Return list of talents
     *
     *
     * @return \App\Http\Resources\TalentCollection
     */
    public function index()
    {
        return new TalentCollection(Talent::enabled()->paginate($this->page_size));
    }

    /**
     * Display the specified talent.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show() : JsonResponse
    {
        return successResponse(
            (new TalentResource(
                auth('talent')->user()->fill(
                    Cache::get($this->talent_data_cache_key, []))
                )
            )
        );
    }

    /**
     * Update the specified talent in storage.
     *
     * @param UpdateTalentRequest $requestHTTP request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTalentRequest $request)
    {
        $response = errorResponse('Unable to update talent information!', 400);
        $talent   = auth('talent')->user();

        try {            
            $talent->update($request->validated());

            $this->talentService->deleteCachedResumeData(0, 'talent');

            $response = successResponse($talent->refresh());
        } catch (Throwable $exception) {
            DB::rollBack();
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
    public function destroy(int $id) : JsonResponse
    {
        if ($found_talent = Talent::whereId($id)) {
            
            try {
                $found_talent->forceDelete();
            } catch (Throwable $exception) {
                $found_talent->delete();
            }

            return successResponse();
        }
        
        return errorResponse('Talent not found!', 404);
    }

    /**
     * Store a newly created talent in storage.
     *
     * @param StoreTalentFormRequest $request HTTP request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTalentFormRequest $request)
    {
        $response = errorResponse('Unable to create new talent!', 500);

        try {
            $response = successResponse(Talent::create($request->validated()));
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }
}
