<?php

namespace App\Services;

use App\Models\Vacancy;

class VacancyService {

    /**
     * @var $vacancy
     */
    protected $vacancy;

    /**
     * VacancyService constructor.
     *
     * @param Vacancy $vacancy
     */
    public function __construct(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }


    /**
     * Get all vacancy.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->vacancy->get();
    }

    /**
     * Get vacancy by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->vacancy->where('id', $id)->get();
    }
}

