<?php

namespace App\Http\Requests\talent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
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
            'degree_id'   => [ 'integer', 'exists:degrees,id' ],
            'title'       => [ 'string' ],
            'institution' => [ 'string' ],
            'start_date'  => [ 'date' ],
            'end_date'    => [ 'nullable', 'date' ],
        ];
    }
}
