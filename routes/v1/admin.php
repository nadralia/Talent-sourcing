<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\admin\AdminAuthController;

Route::group([ 'prefix' => 'v1/admins', 'namespace' => 'api\v1' ], function () {
    Route::post('auth', [ AdminAuthController::class, 'store' ]);

    Route::group( ['middleware' => ['auth:admin', 'scopes:admin'] ],function(){
        Route::delete('auth', [ AdminAuthController::class, 'destroy' ]);

        Route::get('test',  function () {
            return successResponse('Authenticated Admin');
        });
    });
});