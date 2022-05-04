<?php

namespace App\Http\Requests\talent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTalentRequest extends FormRequest
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
            'first_name'         => [ 'required', 'string', 'max:32' ],
            'last_name'          => [ 'required', 'string', 'max:32' ],
            'email'              => [ 'required', 'email', 'max:64', Rule::unique('talents')->ignore(auth('talent')->id()) ],
            'birthday'           => [ 'nullable', 'string', ],
            'password'           => [ 'confirmed', 'string', 'min:6' ],
            'avatar'             => [ 'nullable', 'string', 'max:64', 'file'  ],
            'phone'              => [ 'required', 'numeric', 'min:5' ],
            'title_id'           => [ 'required', 'integer', 'exists:titles,id' ],
            'linkedin'           => [ 'required', 'string', 'max:64', 'url' ],
            'address'            => [ 'nullable', 'string', 'max:64' ],
            'github'             => [ 'nullable', 'string', 'max:64', 'url' ],
            'twitter'            => [ 'nullable', 'string', 'max:64', 'url' ],
            'website'            => [ 'nullable', 'string', 'max:64', 'url' ],
            'nationality'        => [ 'required', 'string', 'size:2', 'exists:countries,id' ],
            'country_id'         => [ 'required', 'string', 'size:2', 'exists:countries,id' ],
            'gender_id'          => [ 'required', 'integer', 'exists:genders,id' ],
            'notice_period_id'   => [ 'required', 'integer', 'exists:notice_periods,id' ],
            'min_salary'         => [ 'required', 'integer' ],
            'max_salary'         => [ 'required', 'integer', 'gt:min_salary' ],
            'salary_currency_id' => [ 'required', 'string', 'size:3', 'exists:currencies,id' ],
            'state_id'           => [ 'required', 'integer', 'exists:states,id' ],
            'remote_type_id'     => [ 'required', 'integer', 'exists:remote_types,id' ],
            'title_start_date'   => [ 'required', 'date' ],
        ];
    }
}
