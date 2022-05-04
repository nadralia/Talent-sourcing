<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        \App\Events\TalentUpdated::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
            \App\Listeners\ClearPlainTalentPassword::class,
        ],

        \App\Events\TalentLanguageCreated::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],
    
        \App\Events\TalentLanguageDeleted::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],

        \App\Events\TalentSkillCreated::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],

        \App\Events\TalentSkillDeleted::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],

        \App\Events\EducationCreated::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],

        \App\Events\EducationDeleted::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],

        \App\Events\ExperienceCreated::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],

        \App\Events\ExperienceDeleted::class => [
            \App\Listeners\UpdateTalentProfileCompleteness::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
