<?php

use App\Http\Controllers\api\v1\vacancies\VacancyController;
use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => 'v1/vacancies' ], function () {
    Route::get('/', [ VacancyController::class, 'index' ])->middleware('auth:admin,business,talent');
});