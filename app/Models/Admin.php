<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Admin extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
       'name',
       'email',
       'password',
       'enabled'
    ];

    /**
     * Define what and how things get logged
     *
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Takes string password and Hashes ir
     *
     * @param string $value The password to hash
     *
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

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
}
