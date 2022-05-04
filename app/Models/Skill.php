<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'enabled',
        'start_date',
        'added_by',
    ];

    /**
     * Get the Enabled attribute of this model
     *
     */
    public function getIsEnabledAttribute(): bool
    {
        return $this->enabled;
    }

    /**
     * Get the Disabled attribute of this model
     *
     */
    public function getIsDisabledAttribute(): bool
    {
        return ! $this->enabled;
    }

    /**
     * Scope builder to enabled models
     *
     */
    public function scopeEnabled($query): Builder
    {
        return $query->where('enabled', 1);
    }

    /**
     * Scope builder to disabled models
     *
     */
    public function scopeDisabled($query): Builder
    {
        return $query->where('enabled', '<>', 1);
    }

    /**
     * Scope to include skills added by the authented talent
     *
     */
    public function scopeAddedByTalent() : Builder
    {
        return $this->where('added_by', auth('talent')->user()->id)->orWhereNull('added_by');
    }

    /**
     * A skill can belong to one talent
     *
     * 
     */
    public function addedBy() : BelongsTo
    {
        return $this->belongsTo(Talent::class, 'added_by');
    }
}
