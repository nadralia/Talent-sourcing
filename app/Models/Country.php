<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [ 'id' => 'string' ];

    protected $fillable = [
        'name',
        'code',
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

    /**
     * A country has many states
     *
     *
     * @return /Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states() : HasMany
    {
        return $this->hasMany(State::class)->enabled();
    }

    /**
     * A country belongs to one currency
     *
     *
     * @return /Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function currency() : BelongsTo
    {
        return $this->belongsTo(Currency::class)->enabled();
    }
}
