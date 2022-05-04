<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\TalentSkill;

class TalentSkillDeleted
{
    use SerializesModels;

    public $talent;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\TalentSkill $talent
     * 
     * @return void
     */
    public function __construct(public TalentSkill $talent_skill)
    {
        $this->talent = $this->talent_skill->talent;
    }
}
