<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\talent\TalentAuthController;
use App\Http\Controllers\api\v1\talent\TalentController;
use App\Http\Controllers\api\v1\talent\EducationController;
use App\Http\Controllers\api\v1\talent\ExperienceController;
use App\Http\Controllers\api\v1\talent\TalentLanguageController;
use App\Http\Controllers\api\v1\talent\ResumeController;
use App\Http\Controllers\api\v1\talent\TalentCultureFitController;
use App\Http\Controllers\api\v1\talent\TalentSkillController;
use App\Http\Controllers\api\v1\talent\ProfileCompletenessController;

Route::group([ 'prefix' => 'v1/talents' ], function () {
    Route::post('auth', [ TalentAuthController::class, 'store' ]);

    Route::group( ['middleware' => ['auth:talent', 'scopes:talent'] ],function(){
        Route::delete('auth', [ TalentAuthController::class, 'destroy' ]);

        Route::controller(EducationController::class)->prefix('educations')
            ->group(function () {
                Route::get('/',              'index');
                Route::post('/',             'store');
                Route::patch('{talent_id}',  'update');
                Route::delete('{talent_id}', 'destroy');
        });

        Route::controller(ExperienceController::class)->prefix('experiences')
            ->group(function () {
                Route::get('/',                  'index');
                Route::post('/',                 'store');
                Route::patch('{experience_id}',  'update');
                Route::delete('{experience_id}', 'destroy');
        });
    
        Route::controller(TalentSkillController::class)->prefix('skills')
            ->group(function () {
                Route::get('/',             'index');
                Route::post('/',            'store');
                Route::patch('{skill_id}',  'update');
                Route::delete('{skill_id}', 'destroy');
        });

        Route::controller(TalentLanguageController::class)
            ->prefix('languages')
            ->group(function () {
                Route::get('/',                'index');
                Route::post('/',               'store');
                Route::patch('{language_id}',  'update');
                Route::delete('{language_id}', 'destroy');
        });

        Route::controller(ResumeController::class)
            ->prefix('resumes')
            ->group(function () {
                Route::get('/',              'index');
                Route::post('/',             'store');
                Route::get('{resume_id}',    'show');
                Route::patch('{resume_id}',  'update');
                Route::delete('{resume_id}', 'destroy');
        });

        Route::controller(TalentCultureFitController::class)
            ->prefix('culture-fit')
            ->group(function () {
                Route::get('/',   'index');
                Route::patch('/', 'update');
        });

        Route::get('completeness', [ ProfileCompletenessController::class, 'show' ]);
    });

    Route::controller(TalentController::class)->group(function () {
        Route::get('/',           'index');
        Route::post('/',          'store');
        Route::get('{talent}',    'show');
        Route::patch('{talent}',  'update');
        Route::delete('{talent}', 'destroy');
    });
});
