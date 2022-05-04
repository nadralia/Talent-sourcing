<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'business_id'         => [ 'nullable', 'integer' ],
            'title'               => [ 'string', 'max:32' ],
            'description'         => [ 'string'],
            'country_id'          => [ 'nullable', 'string' ],
            'state_id'            => [ 'nullable', 'integer' ],
            'seniority_id'        => [ 'nullable', 'integer' ],
            'degree_id'           => [ 'nullable', 'integer' ],
            'remote_type_id'      => [ 'nullable', 'integer' ],
            'has_relocation'      => [ 'integer'],
            'min_salary'          => [ 'integer'],
            'max_salary'          => [ 'integer' ],
            'min_years'           => [ 'integer' ],
            'max_years'           => [ 'integer' ],
            'featured'            => [ 'integer'],
            'vetting_score'       => [ 'integer'],
            'video_instructions'  => [ 'string', 'max:32' ],
            'enabled'             => [ 'integer'],
        ];
    }
}
