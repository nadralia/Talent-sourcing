<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancySkill extends Model
{
    use HasFactory;
    use SoftDeletes;
                             
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'skill_id',
        'vacancy_id',
        'min_years',
        'max_years',
        'must_have',
        'min_vetting_score',
        'enabled',
    ];

    /**
     * Get the Enabled attribute of this model
     */
    public function getIsEnabledAttribute() : bool
    {
      return $this->enabled;
    }

    /**
     * Get the Disabled attribute of this model
     */
    public function getIsDisabledAttribute() : bool
    {
        return !$this->enabled;
    }

    /**
     * Scope a query to only include enabled models
     */
    public function scopeEnabled($query) : Builder
    {
        return $query->where('enabled', 1);
    }

    /**
     * Scope a query to only include disabled models
     */
    public function scopeDisabled($query): Builder
    {
        return $query->where('enabled', '<>', 1);
    }
}
