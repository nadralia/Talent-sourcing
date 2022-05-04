<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            'id'         => $this->id,
            'enabled'    => $this->enabled,
            'name'       => $this->name,
            'email'      => $this->email,
            'logo'       => $this->logo,
            'size'       => $this->size,
            'country'    => $this->country->name ?? null,
            'state'      => $this->state->name ?? null,
            'industry'   => $this->industry->name ?? null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
