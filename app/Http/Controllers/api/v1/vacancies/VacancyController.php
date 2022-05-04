<?php

namespace App\Http\Controllers\api\v1\vacancies;

use App\Models\Vacancy;
use App\Http\Resources\VacancyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVacancyFormRequest;
use App\Http\Requests\StoreVacancyFormRequest;
use App\Http\Resources\VacancyCollection;

class VacancyController extends Controller
{
    protected $page_size;

    public function __construct()
    {
        $this->page_size = config('app.default_pagination_size');
    }

    /**
     * Return list of vacancies
     *
     *
     * @return \App\Http\Resources\VacancyCollection
     */
    public function index()
    {
        return new VacancyCollection(Vacancy::enabled()->paginate($this->page_size));
    }

    /**
     * Store a newly created vacancy in storage.
     *
     * @param StoreVacancyFormRequest    $request HTTP request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVacancyFormRequest $request)
    {
        $response = errorResponse('Unable to create new vacancy!', 500);

        try {
            $response = successResponse(Vacancy::create($request->validated()));
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }

    /**
     * Display the specified vacancy.
     *
     * @param int $id Primary key of vacancy of interest
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $response = errorResponse('Job Vacancy not found!', 404);

        if ($found_vacancy = Vacancy::whereId($id)->enabled()->first()) {
            $response = successResponse(new VacancyResource($found_vacancy));
        }
        
        return $response;
    }


    /**
     * Update the specified vacancy in storage.
     *
     * @param  UpdateVacancyFormRequest $request HTTP request
     * @param  Vacancy                  $vacancy  Vacancy model
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVacancyFormRequest $request, Vacancy $vacancy)
    {
        $response = errorResponse('Unable to update vacancy information!', 400);
    
        try {
            $vacancy->update($request->validated());

            $response = successResponse($vacancy->refresh());
        } catch (Throwable $exception) {
            Log::error($exception);
        }

        return $response;
    }

    /**
     * Remove the specified vacancy from storage.
     *
     * @param int $id Primary key of vacancy of interest
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) : JsonResponse
    {
        if ($found_vacancy = Vacancy::whereId($id)) {
            $found_vacancy->delete();

            return successResponse();
        }
        
        return errorResponse('Vacancy not found!', 404);
    }
}
