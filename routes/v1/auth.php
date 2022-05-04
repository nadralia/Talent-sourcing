<?php

use App\Http\Controllers\api\v1\RequestPasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ResetPasswordController;

Route::group([ 'prefix' => 'v1', 'namespace' => 'api\v1'], function () {
    Route::post('{broker}/reset-password-request', [ RequestPasswordResetController::class, 'store' ])
        // we need to ensure the broker is a valid provider
        ->where('broker', implode('|', array_keys(config('auth.providers'))));

    Route::post('{broker}/reset-password', [ ResetPasswordController::class, 'store' ])
        ->where('broker', implode('|', array_keys(config('auth.providers'))));
});
