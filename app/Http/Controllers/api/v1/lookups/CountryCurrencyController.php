<?php

namespace App\Http\Controllers\api\v1\lookups;

use App\Http\Resources\CountryCurrencyResource;
use App\Models\Country;

class CountryCurrencyController
{
    /**
     * Return list of talents
     *
     *
     * @return \App\Http\Resources\EducationCollection
     */
    public function index(string $country_id)
    {
        $model = Country::whereId($country_id);

        if (auth('admin')->check()) {
            $data = $model->get();
        } else {
            $data = $model->enabled()->get();
        }
        
        return CountryCurrencyResource::collection($data);
    }
}
