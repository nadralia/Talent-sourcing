<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Education;

class EducationCreated
{
    use SerializesModels;

    public $talent;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Education $education
     * 
     * @return void
     */
    public function __construct(public Education $education)
    {
        $this->talent = $this->education->talent;
    }
}
