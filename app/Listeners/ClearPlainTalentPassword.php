<?php

namespace App\Listeners;

use App\Events\TalentUpdated;
use Illuminate\Support\Facades\Log;

class ClearPlainTalentPassword
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\TalentUpdated  $event
     * @return void
     */
    public function handle(TalentUpdated $event)
    {
        try {
            if (array_key_exists('password', $event->talent->getChanges())) {
                $event->talent->removeData('password');
            }
        } catch (\Throwable $throwable) {
            Log::error('ClearPlainTalentPasswordError', [
                'talent_id' => $event->talent->id,
                'error'     => $throwable->getMessage(),
            ]);
        }
    }
}
