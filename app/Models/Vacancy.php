<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;
                 
    protected $casts = [
        'has_relocation' => 'boolean',
        'enabled'        => 'boolean',
    ];

    protected $fillable = [
        'business_id',
        'title',
        'description',
        'country_id',
        'state_id',
        'seniority_id',
        'degree_id',
        'remote_type_id',
        'has_relocation',
        'min_salary',
        'max_salary',
        'min_years',
        'max_years',
        'featured',
        'vetting_score',
        'video_instructions',
        'enabled',
    ];

    /**
     * Get the Enabled attribute of this model
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
     *
     * @return bool
     */
    public function getIsDisabledAttribute(): bool
    {
        return ! $this->enabled;
    }

    /**
     * A vacancy belongs to one business
     *
     */
    public function business() : BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * A vacancy belongs to one country
     *
     */
    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * A vacancy belongs to one state
     *
     */
    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * A vacancy belongs to one seniority level
     *
     */
    public function seniority() : BelongsTo
    {
        return $this->belongsTo(Seniority::class);
    }

    /**
     * A vacancy belongs to one remote type
     *
     */
    public function remote_type() : BelongsTo
    {
        return $this->belongsTo(RemoteType::class);
    }

    /**
     * Scope a query to only include enabled models
     *
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('enabled', 1);
    }

    /**
     * Scope a query to only include disabled models
     *
     */
    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('enabled', '<>', 1);
    }

    /**
     * Only vacancies belonging to the authenticated business.
     *
     *
     * @return Builder
     */
    public function scopeBelongsToBusiness(Builder $query) : Builder
    {
        return $query->where('business_id', auth('business')?->user()?->id ?? null);
    }
}
