<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resume extends Model
{
    use HasFactory;
    use SoftDeletes;
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'talent_id',
        'name',
        'file_name',
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

    /**
     * A resume belongs to a talent
     *
     */
    public function talent() : BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }
}
