<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\TalentUpdated;

class Language extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $casts = [ 'id' => 'string' ];

    protected $dispatchesEvents = [
        'created' => TalentUpdated::class,
        'deleted' => TalentUpdated::class,
    ];

    protected $fillable = [
        'name',
        'enabled',
        'is_default'
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
        return ! $this->enabled;
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
