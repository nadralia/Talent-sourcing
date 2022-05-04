<?php

namespace App\Models;

use App\Events\ExperienceCreated;
use App\Events\ExperienceDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dispatchesEvents = [
        'created' => ExperienceCreated::class,
        'deleted' => ExperienceDeleted::class,
    ];

    protected $fillable = [
        'talent_id',
        'company_name',
        'state_id',
        'country_id',
        'seniority_id',
        'title_id',
        'description',
        'industry_id',
        'start_date',
        'end_date',
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
     * Get year and month only of start_date
     *
     */
    public function getStartDateAttribute() : string
    {
        return substr($this->attributes['start_date'], 0, 7);
    }

    /**
     * Get year and month only of end_date
     *
     */
    public function getEndDateAttribute() : string
    {
        return substr($this->attributes['end_date'], 0, 7);
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
     * An experience has one country
     *
     */
    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * An experience belongs to one state/city
     *
     */
    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }


    /**
     * An experience belongs to one industry
     *
     */
    public function industry() : BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }


    /**
     * An experience belongs to one title
     *
     */
    public function title() : BelongsTo
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * An experience belongs to one seniority
     *
     */
    public function seniority() : BelongsTo
    {
        return $this->belongsTo(Seniority::class);
    }

    /**
     * A record belongs to one talent
     *
     *
     * @return BelongsTo
     */
    public function talent() : BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }
}
