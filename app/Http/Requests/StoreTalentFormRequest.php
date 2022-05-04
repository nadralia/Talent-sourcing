<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTalentFormRequest extends FormRequest
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
            'first_name'       => [ 'required', 'string', 'max:32' ],
            'last_name'        => [ 'required', 'string', 'max:32' ],
            'email'            => [ 'required', 'email', 'max:64' ],
            'password'         => [ 'required', 'string', 'min:6' ],
            'avatar'           => [ 'nullable', 'string', 'max:64' ],
            'phone'            => [ 'nullable', 'string', 'max:15' ],
            'title_id'         => [ 'required', 'integer' ],
            'linkedin'         => [ 'nullable', 'string', 'max:64' ],
            'github'           => [ 'nullable', 'string', 'max:64' ],
            'twitter'          => [ 'nullable', 'string', 'max:64' ],
            'website'          => [ 'nullable', 'string', 'max:64' ],
            'nationality'      => [ 'required', 'string', 'max:3' ],
            'gender_id'        => [ 'nullable', 'integer' ],
            'referral_code'    => [ 'nullable', 'string', 'max:6' ],
            'referrer'         => [ 'nullable', 'integer' ],
            'admin_id'         => [ 'nullable', 'integer' ],
            'do_not_contact'   => [ 'nullable', 'integer' ],
            'notice_period_id' => [ 'required', 'integer' ],
            'min_salary'       => [ 'required', 'integer' ],
            'max_salary'       => [ 'required', 'integer', 'gt:min_salary' ],
            'title_start_date' => [ 'required', 'date' ],
        ];
    }
}
