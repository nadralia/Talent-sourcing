<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Talent;
use Carbon\Carbon;
use App\Models\SkillLevel;
use App\Events\TalentSkillCreated;
use App\Events\TalentSkillDeleted;

class TalentSkill extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dispatchesEvents = [
        'created' => TalentSkillCreated::class,
        'deleted' => TalentSkillDeleted::class,
    ];

    protected $casts = [
        'is_primary'   => 'boolean',
        'is_secondary' => 'boolean',
    ];

    protected $fillable = [
        'talent_id',
        'skill_id',
        'start_date',
        'skill_level_id',
        'is_primary',
        'is_secondary',
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
     * Get years of experience based on start_date value
     *
     * @param null
     *
     *
     * @return int
     */
    public function getYearsAttribute(): int
    {
        return Carbon::parse($this->start_date)->diffInYears(now());
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
     * Scope primary skills only
     *
     */
    public function scopePrimary($query): Builder
    {
        return $query->where('is_primary', 1);
    }

    /**
     * Scope secondary skills only
     *
     */
    public function scopeSecondary($query): Builder
    {
        return $query->where('is_secondary', 1);
    }

    /**
     * A record belongs to one skill
     *
     *
     * @return BelongsTo
     */
    public function skill() : BelongsTo
    {
        return $this->belongsTo(Skill::class);
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

    /**
     * A record belongs to one skill level
     *

     *
     * @return BelongsTo
     */
    public function skillLevel() : BelongsTo
    {
        return $this->belongsTo(SkillLevel::class);
    }
}
