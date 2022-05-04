<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TalentResource extends JsonResource
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
            'id'                 => $this->id,
            'enabled'            => $this->enabled,
            'email'              => $this->email,
            'avatar'             => $this->avatar,
            'first_name'         => $this->first_name,
            'last_name'          => $this->last_name,
            'initials'           => $this->initials,
            'title_id'           => $this->title_id,
            'title_start_date'   => $this->title_start_date,
            'years_experience'   => $this->years_experience,
            'title'              => $this->title?->name,
            'phone'              => $this->phone,
            'birthday'           => $this->birthday,
            'nationality'        => $this->nationality,
            'nationality_name'   => $this->nationalityCountry?->name,
            'country_id'         => $this->country_id,
            'country'            => $this->country?->name,
            'address'            => $this->address,
            'gender_id'          => $this->gender_id,
            'gender'             => $this->gender?->name,
            'min_salary'         => $this->min_salary,
            'max_salary'         => $this->max_salary,
            'salary_currency_id' => $this->salary_currency_id,
            'salary_currency'    => $this->salaryCurrency?->name,
            'notice_period_id'   => $this->notice_period_id,
            'notice_period'      => $this->noticePeriod?->name,
            'completeness'       => $this->getData('completeness', 'int', 0),
            'linkedin'           => $this->linkedin,
            'github'             => $this->github,
            'twitter'            => $this->twitter,
            'website'            => $this->website,
            'state_id'           => $this->state_id,
            'state'              => $this->state?->name,
            'remote_type_id'     => $this->remote_type_id,
            'remote_type'        => $this->remoteType?->name,
            'job_status_id'      => $this->job_status_id,
            'job_status'         => $this->jobStatus?->name,
        ];
    }
}
