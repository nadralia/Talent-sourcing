<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LookupResource extends JsonResource
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
            'enabled'     => $this->when(auth('admin')->check(), $this->enabled),
            'name'        => $this->name,
            'is_default'  => $this->when(auth('admin')->check() && $this->is_default, $this->is_default),
            'description' => $this->when($this->description, $this->description),
            'max_choices' => $this->when($this->max_choices, $this->max_choices),
        ];
    }
}
