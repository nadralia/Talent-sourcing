<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TalentSkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'enabled'          => $this->enabled,
            'skill_id'         => $this->skill_id,
            'skill'            => $this->skill?->name,
            'is_primary'       => $this->is_primary,
            'is_secondary'     => $this->is_secondary,
            'skill_level_id'   => $this->skill_level_id,
            'skill_level'      => $this->skillLevel?->name,
            'start_date'       => substr($this->start_date, 0, 7),
            'years_experience' => $this->years,
        ];
    }
}
