<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\RequestPasswordResetController;
use App\Http\Controllers\api\v1\ResetPasswordController;
use App\Http\Controllers\api\v1\talent\TalentAuthController;
use App\Http\Controllers\api\v1\talent\TalentController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

foreach (File::allFiles(__DIR__ . '/v1') as $route_file) {
    require $route_file->getPathname();
}

Route::group([ 'prefix' => 'v1/passwords', 'namespace' => 'api\v1' ], function () {
    Route::post('request-reset', [ RequestPasswordResetController::class, 'store' ]);
    Route::post('reset', [ ResetPasswordController::class, 'store' ]);
});

// Temp endpoints for old talents to fill in new information
Route::group([ 'prefix' => 'update-profile', 'namespace' => 'update-profile' ], function () {
    Route::post('auth', [ TalentAuthController::class, 'store' ]);

    Route::group(['middleware' => [ 'auth:talent', 'scopes:talent' ] ], function () {
        Route::delete('auth', [ TalentAuthController::class, 'destroy' ]);
        Route::patch('/', [ TalentController::class,     'update' ]);
        Route::get('/', [ TalentController::class,     'show' ]);

        // TODO: Remove after
        Route::delete('finish', function () {
            Artisan::call('borderless:clear-cached-resume ' . auth('talent')->id());
            return successResponse();
        });
    });
});
