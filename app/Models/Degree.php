<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Degree extends Model
{
    use SoftDeletes;

    const HIGHSCHOOL   = 1;
    const ASSOCIATE    = 2;
    const PROFESSIONAL = 3;
    const BACHELOR     = 4;
    const POSTGRADUATE = 5;
    const MASTER       = 6;
    const DOCTORAL     = 7;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'enabled'
    ];

    /**
     * Get the Enabled attribute of this model
     * 
     * @param null
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
     * @return bool
     */

    public function getIsDisabledAttribute(): bool
    {
        return !$this->enabled;
    }

    /**
     * Scope a query to only include enabled models
     * 
     * @param  Illuminate\Database\Eloquent\Builder $query
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
     * @return Illuminate\Database\Eloquent\Builder
     */

    public function scopeDisabled($query): Builder
    {
        return $query->where('enabled', '<>', 1);
    }
}
