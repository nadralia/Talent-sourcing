<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seniority extends Model
{
    use HasFactory;
    use SoftDeletes;

    const JUNIOR       = 1;
    const INTERMEDIATE = 2;
    const SENIOR       = 3;
    const MANAGER      = 4;
    const DIRECTOR     = 5;
    const EXECUTIVE    = 6;
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
