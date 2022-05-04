<?php

namespace App\Http\Requests\talent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
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
            'company_name' => [ 'required', 'string' ],
            'description'  => [ 'required', 'string' ],
            'seniority_id' => [ 'required', 'integer', 'exists:seniorities,id' ],
            'title_id'     => [ 'required', 'integer', 'exists:titles,id' ],
            'industry_id'  => [ 'required', 'integer', 'exists:industries,id' ],
            'state_id'     => [ 'required', 'integer', 'exists:states,id' ],
            'country_id'   => [ 'required', 'string', 'size:2', 'exists:countries,id' ],
            'start_date'   => [ 'required', 'date' ],
            'end_date'     => [ 'nullable', 'date' ],
            'enabled'      => [ 'boolean' ],
        ];
    }
}
