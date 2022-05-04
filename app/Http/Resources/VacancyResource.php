<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * 
     * 
     * @return Array
     */
    public function toArray($request) : Array
    {
        return [
            'id'                 => $this->id,
            'enabled'            => $this->enabled,
            'business'           => $this->business?->name,
            'business_id'        => $this->business_id,
            'title'              => $this->title,
            'description'        => $this->description,
            'country'            => $this->country?->name,
            'country_id'         => $this->country_id,
            'state'              => $this->state?->name,
            'state_id'           => $this->state_id,
            'seniority'          => $this->seniority?->name,
            'seniority_id'       => $this->seniority_id,
            'degree'             => $this->degree?->name,
            'degree_id'          => $this->degree_id,
            'remote_type'        => $this->remote_type?->name,
            'remote_type_id'     => $this->remote_type_id,
            'has_relocation'     => $this->has_relocation,
            'min_salary'         => $this->min_salary,
            'max_salary'         => $this->max_salary,
            'min_years'          => $this->min_years,
            'max_years'          => $this->max_years,
            'featured'           => $this->featured,
            'vetting_score'      => $this->vetting_score,
            'video_instructions' => $this->video_instructions,
        ];
    }
}
