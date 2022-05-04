<?php

namespace App\Http\Controllers\api\v1\business;

use App\Models\Vacancy;
use App\Http\Resources\VacancyResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVacancyFormRequest;
use App\Http\Requests\StoreVacancyFormRequest;
use App\Http\Resources\VacancyCollection;

class BusinessVacancyController extends Controller
{
    protected $page_size;

    public function __construct()
    {
        $this->page_size = config('app.default_pagination_size');
    }

    /**
     * Return list of vacancies beloging to the authenticated business.
     *
     *
     * @return \App\Http\Resources\VacancyCollection
     */
    public function index()
    {
        return new VacancyCollection(Vacancy::belongsToBusiness()->orderByDesc('created_at')->paginate($this->page_size));
    }

    /**
     * Store a newly created vacancy in storage.
     *
     * @param StoreVacancyFormRequest $request HTTP request
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVacancyFormRequest $request) : JsonResponse
    {
        Vacancy::belongsToBusiness()->create($request->validated());

        return successResponse();
    }

    /**
     * Display the specified vacancy.
     *
     * @param int $vacancy_id Primary key of vacancy of interest
     * 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $vacancy_id) : JsonResponse
    {
        $response = errorResponse('Job Vacancy not found!', 404);

        if ($found_vacancy = Vacancy::whereId($vacancy_id)->belongsToBusiness()->first()) {
            $response = successResponse(new VacancyResource($found_vacancy));
        }
        
        return $response;
    }


    /**
     * Update the specified vacancy in storage.
     *
     * @param  UpdateVacancyFormRequest $request    HTTP request
     * @param  int                      $vacancy_id Primary key of vacancy of interest  
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVacancyFormRequest $request, int $vacancy_id)
    {
        if ($found_vacancy = Vacancy::belongsTobusiness()->whereId($vacancy_id)) {
            $found_vacancy->update($request->validated());

            return successResponse();
        }

        return errorResponse('Unable to update vacancy information!', 400);
    }

    /**
     * Remove the specified vacancy from storage.
     *
     * @param int $vacancy_id Primary key of vacancy of interest
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($vacancy_id) : JsonResponse
    {
        if ($found_vacancy = Vacancy::belongsTobusiness()->whereId($vacancy_id)) {
            $found_vacancy->delete();

            return successResponse();
        }
        
        return errorResponse('Vacancy not found!', 404);
    }
}
