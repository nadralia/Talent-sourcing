<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Talent;

class TalentUpdated
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Talent $talent
     * 
     * @return void
     */
    public function __construct(public Talent $talent)
    {
        //
    }
}
