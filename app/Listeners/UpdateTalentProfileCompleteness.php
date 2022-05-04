<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class UpdateTalentProfileCompleteness
{
    /**
     * Handle the event.
     *
     * @param mixed $event
     * @return void
     */
    public function handle(mixed $event)
    {
        try {
            $event->talent->updateProfileCompleteness();
        } catch (\Throwable $throwable) {
            Log::error('UpdateTalentProfileCompletenessError', [
                'talent_id' => $event->talent->id,
                'error'     => $throwable->getMessage(),
            ]);
        }
    }
}
