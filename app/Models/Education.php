<?php

namespace App\Models;

use App\Events\EducationDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Degree;
use App\Events\EducationCreated;

class Education extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'educations';

    protected $dispatchesEvents = [
        'created' => EducationCreated::class,
        'deleted' => EducationDeleted::class,
    ];

    protected $fillable = [
        'talent_id',
        'degree_id',
        'title',
        'institution',
        'start_date',
        'end_date',
        'enabled',
    ];

    /**
     * Get the Enabled attribute of this model
     */
    public function getIsEnabledAttribute() : bool
    {
      return $this->enabled;
    }

    /**
     * Get the Disabled attribute of this model
     */
    public function getIsDisabledAttribute() : bool
    {
        return !$this->enabled;
    }

    /**
     * Applies ucwords() to title
     *
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    /**
     * Applies ucwords() to title
     *
     */
    public function setInstitutioneAttribute($value)
    {
        $this->attributes['institution'] = ucwords($value);
    }

    /**
     * Scope a query to only include enabled models
     */
    public function scopeEnabled($query) : Builder
    {
        return $query->where('enabled', 1);
    }

    /**
     * Scope a query to only include disabled models
     */
    public function scopeDisabled($query): Builder
    {
        return $query->where('enabled', '<>', 1);
    }

    /**
     * Scope to only include the authenticated talent's educations
     * 
     */
    public function scopeAuthTalent(Builder $query)
    {
        return $query->whereTalentId(auth('talent')->id());
    }

    /**
     * Get the education's degree
     *
     */
    public function degree() : BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }

    /**
     * A record belongs to one talent
     *
     */
    public function talent() : BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }
}
