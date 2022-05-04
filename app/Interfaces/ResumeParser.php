<?php

namespace App\Interfaces;

interface ResumeParser
{
    /**
     * Parse a talent's resume
     *
     * @param int   $talent_id Primary key of the talent who owns this resume
     * @param array $resume    Resume data output from parsin API
     * 
     *
     * @return \App\Http\Resources\TalentResource
     */
    public function parseResume(int $talent_id, array $resume_data = null);
}