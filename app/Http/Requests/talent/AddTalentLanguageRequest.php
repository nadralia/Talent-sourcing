<?php

namespace App\Http\Requests\talent;

use Illuminate\Foundation\Http\FormRequest;

class AddTalentLanguageRequest extends FormRequest
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
            'language_id'       => [ 'required', 'string', 'size:2', 'exists:languages,id' ],
            'language_level_id' => [ 'required', 'integer', 'exists:language_levels,id' ],
        ];
    }
}
