<?php

namespace App\Services;

use App\Models\Skill;

class SkillService {

    /**
     * @var $skill
     */
    protected $skill;

    /**
     * SkillService constructor.
     *
     * @param Skill $skill
     */
    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }


    /**
     * Get all skill.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->skill->get();
    }

    /**
     * Get skill by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->skill->where('id', $id)->get();
    }
}

