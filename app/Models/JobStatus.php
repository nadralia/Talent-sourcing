<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class JobStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
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
}
