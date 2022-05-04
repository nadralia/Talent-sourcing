<?php

namespace App\Http\Requests\talent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTalentSkillRequest extends FormRequest
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
            'skill_id'       => [ 'integer', 'exists:skills,id' ],
            'skill_level_id' => [ 'integer', 'exists:skill_levels,id' ],
            'is_primary'     => [ 'boolean', 'required_without:is_secondary' ],
            'is_secondary'   => [ 'boolean', 'required_without:is_primary' ],
            'start_date'     => [ 'date' ],
            'enabled'        => [ 'boolean' ],
        ];
    }
}
