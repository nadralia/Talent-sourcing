<?php

namespace App\Services;

use App\Models\Experience;

class ExperienceService {

    /**
     * @var $experience
     */
    protected $experience;

    /**
     * ExperienceService constructor.
     *
     * @param Experience $experience
     */
    public function __construct(Experience $experience)
    {
        $this->experience = $experience;
    }


    /**
     * Get all experience.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->experience->get();
    }

    /**
     * Get experience by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->experience->where('id', $id)->get();
    }
}

