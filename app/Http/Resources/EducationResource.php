<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
            'id'          => $this->id,
            'enabled'     => $this->enabled,
            'title'       => $this->title,
            'institution' => $this->institution,
            'degree_id'   => $this->degree_id,
            'degree'      => $this->degree?->name,
            'start_date'  => substr($this->start_date, 0, 7),
            'end_date'    => substr($this->end_date, 0, 7),
        ];
    }
}
