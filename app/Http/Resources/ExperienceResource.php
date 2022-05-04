<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
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
            'id'           => $this->id,
            'enabled'      => $this->enabled,
            'company_name' => $this->company_name,
            'description'  => $this->description,
            'seniority_id' => $this->seniority_id,
            'seniority'    => $this->seniority?->name,
            'title_id'     => $this->title_id,
            'title'        => $this->title?->name,
            'industry_id'  => $this->industry_id,
            'industry'     => $this->industry?->name,
            'start_date'   => $this->start_date,
            'end_date'     => $this->end_date,
            'state_id'     => $this->state_id,
            'state'        => $this->state?->name,
            'country_id'   => $this->country_id,
            'country'      => $this->country?->name,
        ];
    }
}
