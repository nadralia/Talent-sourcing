<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VettingStage extends Model
{
    use HasFactory;
    use SoftDeletes;
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desscription',
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
