<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Models\Talent;
use App\Http\Resources\TalentCollection;
use App\Http\Resources\TalentResource;
use App\Services\TalentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Requests\TalentFormRequest;
use App\Http\Requests\UpdateTalentFormRequest;
use App\Http\Requests\StoreTalentFormRequest;

class AdminTalentController
{
    protected $page_size;
    protected $talent_service;

    public function __construct(TalentService $talent_service)
    {
        $this->page_size = config('app.default_pagination_size');
        
        $this->talent_service = $talent_service;
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
     * @param  int $id Primary key of talent of interest
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $response = errorResponse('Talent not found!', 404);

        if ($found_talent = Talent::whereId($id)->enabled()->first()) {
            $response = successResponse(new TalentResource($found_talent));
        }
        
        return $response;
    }

    /**
     * Update the specified talent in storage.
     *
     * @param  TalentFormRequest $request HTTP request
     * @param  Talent            $talent  Talent model
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTalentFormRequest $request, Talent $talent)
    {
        $response = errorResponse('Unable to update talent information!', 400);
    
        try {
            $talent->update($request->validated());

            $response = successResponse($talent->refresh());
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
    public function destroy(int $id) : JsonResponse
    {
        if ($found_talent = Talent::whereId($id)) {
            $found_talent->delete();

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
