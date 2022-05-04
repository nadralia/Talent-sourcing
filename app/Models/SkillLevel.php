<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillLevel extends Model
{
    use HasFactory;
    use SoftDeletes;
        
    const BEGINNER    = 1;
    const EXPERIENCED = 2;
    const ADVANCE     = 3;
    const EXPERT      = 4;

    protected $fillable = [
        'name',
        'description',
        'enabled',
    ];

    /**
     * Get the Enabled attribute of this model
     *
     * @param null
     *
     *
     * @return bool
     */
    public function getIsEnabledAttribute(): bool
    {
        return $this->enabled;
    }

    /**
     * Get the Disabled attribute of this model
     *
     * @param null
     *
     *
     * @return bool
     */
    public function getIsDisabledAttribute(): bool
    {
        return ! $this->enabled;
    }

    /**
     * Scope a query to only include enabled models
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     *
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query): Builder
    {
        return $query->where('enabled', 1);
    }

    /**
     * Scope a query to only include disabled models
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     *
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeDisabled($query): Builder
    {
        return $query->where('enabled', '<>', 1);
    }
}
