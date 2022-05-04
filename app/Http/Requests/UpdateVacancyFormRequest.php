<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyFormRequest extends FormRequest
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
            'business_id'         => [ 'integer' ],
            'title'               => [ 'string', 'max:32' ],
            'description'         => [ 'string', 'max:64' ],
            'country_id'          => [ 'integer' ],
            'state_id'            => [ 'integer' ],
            'seniority_id'        => [ 'integer' ],
            'degree_id'           => [ 'integer' ],
            'remote_type_id'      => [ 'integer' ],
            'has_relocation'      => [ 'string', 'max:32' ],
            'min_salary'          => [ 'string', 'max:32' ],
            'max_salary'          => [ 'integer' ],
            'min_years'           => [ 'integer' ],
            'max_years'           => [ 'integer' ],
            'featured'            => [ 'string', 'max:32' ],
            'vetting_score'       => [ 'string', 'max:32' ],
            'video_instructions'  => [ 'string', 'max:32' ],
            'enabled'             => [ 'boolean' ],
        ];
    }
}
