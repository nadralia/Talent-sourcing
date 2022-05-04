<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\TalentLanguage;

class TalentLanguageDeleted
{
    use SerializesModels;

    public $talent;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\TalentLanguage $talent_languagetalent_language
     * 
     * @return void
     */
    public function __construct(public TalentLanguage $talent_language)
    {
        $this->talent = $this->talent_language->talent;
    }
}
