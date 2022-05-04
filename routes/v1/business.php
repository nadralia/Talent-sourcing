<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\BusinessController;
use App\Http\Controllers\api\v1\business\BusinessVacancyController;
use App\Http\Controllers\api\v1\business\BusinessAuthController;

Route::group([ 'prefix' => 'v1/businesses', ], function () {
    Route::get('/',    [ BusinessController::class, 'index' ]);

    Route::post('/auth', [ BusinessAuthController::class, 'store' ]);

    Route::group( ['middleware' => ['auth:business', 'scopes:business'] ],function(){
        Route::delete('auth', [ BusinessAuthController::class, 'destroy' ]);

        Route::controller(BusinessVacancyController::class)->prefix('vacancies')
        ->group(function () {
            Route::get('/',            'index');
            Route::post('/',           'store');
            Route::get('{vacancy}',    'show');
            Route::patch('{vacancy}',  'update');
            Route::delete('{vacancy}', 'destroy');
        });

        Route::get('test',  function () {
            return successResponse('Authenticated');
        });

        // Place all wildcard routes at the bottom
        Route::get('{id}', [ BusinessController::class, 'show' ]);
    });
});