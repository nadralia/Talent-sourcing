<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TalentLanguageResource extends JsonResource
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
            'id'                => $this->id,
            'enabled'           => $this->enabled,
            'language_id'       => $this->language_id,
            'language'          => $this->language?->name,
            'language_level_id' => $this->language_level_id,
            'language_level'    => $this->languageLevel?->name,
        ];
    }
}
