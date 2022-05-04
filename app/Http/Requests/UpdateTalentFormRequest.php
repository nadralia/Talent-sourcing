<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTalentFormRequest extends FormRequest
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
            'first_name'       => [ 'string', 'max:32' ],
            'last_name'        => [ 'string', 'max:32' ],
            'email'            => [ 'email', 'max:64' ],
            'password'         => [ 'string', 'min:6' ],
            'avatar'           => [ 'string', 'max:64' ],
            'phone'            => [ 'string', 'max:15' ],
            'title_id'         => [ 'integer' ],
            'linkedin'         => [ 'string', 'max:64' ],
            'github'           => [ 'string', 'max:64' ],
            'twitter'          => [ 'string', 'max:64' ],
            'website'          => [ 'string', 'max:64' ],
            'nationality'      => [ 'string', 'max:3' ],
            'gender_id'        => [ 'integer' ],
            'enabled'          => [ 'boolean' ],
            'referral_code'    => [ 'string', 'max:6' ],
            'referrer'         => [ 'integer' ],
            'admin_id'         => [ 'integer' ],
            'do_not_contact'   => [ 'integer' ],
            'notice_period_id' => [ 'integer' ],
            'title_start_date' => [ 'date' ],
        ];
    }
}
