<?php

namespace App\Models;

use App\Events\TalentLanguageCreated;
use App\Events\TalentLanguageDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalentLanguage extends Model
{
    use HasFactory;
    use SoftDeletes;
        
    protected $dispatchesEvents = [
        'created' => TalentLanguageCreated::class,
        'deleted' => TalentLanguageDeleted::class,
    ];

    protected $fillable = [
        'talent_id',
        'language_id',
        'language_level_id',
        'enabled'
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
     * A record belongs to one language
     *
     *
     * @return 
     */
    public function language() : BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * A record belongs to one language level
     *
     *
     * @return 
     */
    public function languageLevel() : BelongsTo
    {
        return $this->belongsTo(LanguageLevel::class);
    }

    /**
     * A record belongs to one talent
     *
     *
     * @return 
     */
    public function talent() : BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }
}
