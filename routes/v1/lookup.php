<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\lookups\LookupController;
use App\Http\Controllers\api\v1\lookups\CountryCurrencyController;

Route::group([ 'prefix' => 'v1/lookup' ], function () {
    Route::get('countries/{country_id}/currencies', [ CountryCurrencyController::class, 'index' ]);

    Route::get('{entity}', [ LookupController::class, 'index' ]);

    Route::get('{entity}/{entity_id}/{sub_entity}', [ LookupController::class, 'index' ]);
});