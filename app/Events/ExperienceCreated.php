<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Experience;

class ExperienceCreated
{
    use SerializesModels;

    public $talent;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Experience $experience
     * 
     * @return void
     */
    public function __construct(public Experience $experience)
    {
        $this->talent = $this->experience->talent;
    }
}
