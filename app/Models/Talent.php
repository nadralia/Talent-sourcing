<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use App\Events\TalentUpdated;

class Talent extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;
    use Notifiable;
    use HasRoles;
    use LogsActivity;
        
    protected $table = 'talents';
    protected $casts = [ 'completeness' => 'integer' ];

    protected $dispatchesEvents = [
        'updated' => TalentUpdated::class,
    ];

    protected $fillable = [
        'password',
        'avatar',
        'title_id',
        'first_name',
        'last_name',
        'phone',
        'birthday',
        'linkedin',
        'github',
        'twitter',
        'website',
        'nationality',
        'country_id',
        'state_id',
        'address',
        'gender_id',
        'enabled',
        'referral_code',
        'referrer_id',
        'admin_id',
        'do_not_contact',
        'notice_period_id',
        'title_start_date',
        'min_salary',
        'max_salary',
        'salary_rate',
        'salary_currency_id',
        'remote_type_id',
    ];

    protected $hidden = ['password'];

    /**
     * Add data to talent_data table for this talent.
     *
     * @param string $key   Name/Key of data to save
     * @param string $value Value of data to save
     *
     *
     * @return boolean
     */
    public function addData(string $key, string $value) : bool
    {
        if (TalentData::updateOrCreate([ 'talent_id' => $this->id, 'name' => $key ], [ 'value' => $value ] )) {
            return true;
        }

        return false;
    }

    /**
     * Get value of talent data from talent_table for this talent.
     *
     * @param string $key     Name/Key of data retrieve
     * @param string $cast    Optionally cast value to this type
     * @param string $default Optional default value to return if data is not found
     *
     *
     * @return mixed
     */
    public function getData(string $key, string $cast = 'string', string $default = null) : mixed
    {
        $data = TalentData::whereTalentId($this->id)->whereName($key)->first()?->value ?? $default ?? null;

        settype($data, $cast);

        return $data;
    }

    /**
     * Get all talent data from talent_data table.
     *
     *
     * @return array
     */
    public function getTalentData() : array
    {
        return TalentData::whereTalentId($this->id)->pluck('value', 'name')->toArray() ?? [];
    }

    /**
     * Remove value of talent data from talent_table for this talent.
     *
     * @param string $key Name/Key of data remove
     *
     *
     * @return bool
     */
    public function removeData(string $key) : bool
    {
        return TalentData::whereTalentId($this->id)->whereName($key)->delete();
    }

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
     * Takes string password and Hashes it
     *
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Converts country_id to uppercase
     *
     */
    public function setCountryIdAttribute($value)
    {
        $this->attributes['country_id'] = strtoupper($value);
    }

    /**
     * Converts nationality to uppercase
     *
     */
    public function setNationalityAttribute($value)
    {
        $this->attributes['nationality'] = strtoupper($value);
    }

    /**
     * Applies ucwords() to first name
     *
 
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }

    /**
     * Applies ucwords() to last name
     *
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords($value);
    }

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
     * Is today the talent's birthday?
     *
     */
    public function getIsBirthdayTodayAttribute() : bool
    {
        return $this->birthday == date('m-d');
    }

    /**
     * Get year and month only of end_date
     *
     */
    public function getTitleStartDateAttribute() : string
    {
        return substr($this->attributes['title_start_date'], 0, 7);
    }

    /**
     * Get the talent's years of experience from title_start_date
     *
     */
    public function getYearsExperienceAttribute() : int
    {
        return now()->diffInYears($this->title_start_date);
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
     * Filter by country
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array                                $country_ids Array of primary key of countries of interest
     *
     */
    public function scopeInCountries(Builder $query, array $country_ids): Builder
    {
        return $query->whereHas('country', function ($country) use ($country_ids) {
            $country->enabled()->whereIn('id', $country_ids);
        });
    }

    /**
     * Filter by citizenship
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array                                $country_ids Array of primary key of countries of interest
     *

     */
    public function scopeWithCitizenships(Builder $query, array $country_ids): Builder
    {
        return $query->whereHas('citizenship', function ($country) use ($country_ids) {
            $country->enabled()->whereIn('id', $country_ids);
        });
    }

    /**
     * Filter talents referred by referral_code
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string                                $referral_code
     *
     */
    public function scopeReferredByCode(Builder $query, string $referral_code): Builder
    {
        return $query->whereHas('referrer', function ($query) use ($referral_code) {
            $query->where('referral_code', $referral_code);
        });
    }

    /**
     * Filter talents referred by talent_id
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param int                                  $talent_id
     *
     */
    public function scopeReferredByTalent(Builder $query, string $talent_id): Builder
    {
        return $query->where('referrer_id', $talent_id);
    }

    /**
     * Filter by referral_code
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string                                $referral_code
     *
     */
    public function scopeWithReferralCode(Builder $query, string $referral_code): Builder
    {
        return $query->where('referral_code', $referral_code);
    }

    /**
     * Scope talents with any of the given skills
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     *
     */
    public function scopeWithAnySkills(Builder $query, array $skill_ids)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids) {
            $skills->enabled()->whereIn('skill_id', $skill_ids);
        });
    }

    /**
     * Scope talents with any of the given primary skills
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     *
     */
    public function scopeWithAnyPrimarySkills(Builder $query, array $skill_ids)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids) {
            $skills->enabled()->primary()->whereIn('skill_id', $skill_ids);
        });
    }

    /**
     * Scope talents with any of the given secondary skills
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     *
     */
    public function scopeWithAnySecondarySkills(Builder $query, array $skill_ids)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids) {
            $skills->enabled()->primary()->whereIn('skill_id', $skill_ids);
        });
    }

    /**
     * Scope talents with at least one resume uploaded
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     */
    public function scopeWithResume(Builder $query)
    {
        return $query->whereHas('resumes', function ($resumes) {
            $resumes->enabled();
        });
    }

    /**
     * Scope talents WITHOUT at least one resume uploaded
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $vetting_stage_ids Array of primary key of vetting stages of interest
     *
     */
    public function scopeInVettingStages(Builder $query, array $vetting_stage_ids)
    {
        return $query->whereHas('vettingStages', function ($query) use ($vetting_stage_ids) {
            $query->whereIn('vetting_stage_id', $vetting_stage_ids);
        });
    }

    /**
     * Scope talents WITHOUT at least one resume uploaded
     *
     */
    public function scopeWithoutResume(Builder $query)
    {
        return $query->whereDoesntHave('resumes', function ($resumes) {
            $resumes->enabled();
        });
    }

    /**
     * Scope talents with the given titles
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $title_ids Array of primary key of titles of interest
     *
     */
    public function scopeWithTitles(Builder $query, array $title_ids)
    {
        return $query->whereIn('title_id', $title_ids);
    }

    /**
     * Scope talents with ALL of the given skills
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     *
     */
    public function scopeWithAllSkills(Builder $query, array $skill_ids)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids) {
            $skills->enabled()->whereIn('skill_id', $skill_ids);
        }, '>=', count($skill_ids));
    }

    /**
     * Scope talents with ALL of the given primary skills
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     *
     */
    public function scopeWithAllPrimarySkills(Builder $query, array $skill_ids)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids) {
            $skills->enabled()->primary()->whereIn('skill_id', $skill_ids);
        }, '>=', count($skill_ids));
    }

    /**
     * Scope talents with ALL of the given secondary skills
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     *
     */
    public function scopeWithAllSecondarySkills(Builder $query, array $skill_ids)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids) {
            $skills->enabled()->secondary()->whereIn('skill_id', $skill_ids);
        }, '>=', count($skill_ids));
    }

    /**
     * Filter by gender
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param int                                  $gender_id Primary key of gender of interest
     *
     */
    public function scopeWithGender(Builder $query, int $gender_id): Builder
    {
        return $query->whereHas('gender', function ($gender) use ($gender_id) {
            $gender->enabled()->whereId($gender_id);
        });
    }

    /**
     * Scope talents with ANY of the given skills AND years of experience
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     * @param array                                 $years    Years of experience
     *
     */
    public function scopeWithAnySkillsAndYears(Builder $query, array $skill_ids, array $years_experience)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids, $years_experience) {
            $skills->enabled();

            foreach ($skill_ids as $key => $id) {
                $skills->whereSkillId($id)->where(function ($query) use ($years_experience, $key) {
                    $query->where('start_date', '<=', now()->subYears($years_experience[$key] ?? 1)->startOfMonth()->toDateString());
                });
            }
        });
    }

    /**
     * Scope talents with ALL of the given skills AND years of experience
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $skill_ids Array of primary key of skills of interest
     * @param array                                 $years    Years of experience
     *
     */
    public function scopeWithAllSkillsAndYears($query, $skill_ids, $years_experience)
    {
        return $query->whereHas('skills', function ($skills) use ($skill_ids, $years_experience) {
            $skills->enabled();

            foreach ($skill_ids as $key => $id) {
                $skills->whereSkillId($id)->where(function ($query) use ($years_experience, $key) {
                    $query->where('start_date', '<=', now()->subYears($years_experience[$key] ?? 1)->startOfMonth()->toDateString());
                });
            }
        }, '>=', count($skill_ids));
    }

    /**
     * Scope talents in the given states
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $state_ids Array of primary key of states of interest
     *
     */
    public function scopeInStates(Builder $query, array $state_ids)
    {
        return $query->whereHas('state', function ($query) use ($state_ids) {
            $query->enabled()->whereIn('id', $state_ids);
        });
    }

    /**
     * Filter talents by email
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $email
     *
     */
    public function scopeWithEmail(Builder $query, string $email)
    {
        return $query->where('email', 'like', "%$email%");
    }

    /**
     * Filter talents by phone number
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $phone
     *
     */
    public function scopeWithPhone(Builder $query, string $phone)
    {
        return $query->where('phone', 'like', "%$phone%");
    }

    /**
     * Filter talents added by the given admin
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $admin_id
     *
     */
    public function scopeAddedByAdmin(Builder $query, int $admin_id)
    {
        return $query->where('admin_id', $admin_id);
    }

    /**
     * Filter talents with DND enabled
     *
     */
    public function scopeWithDnd(Builder $query)
    {
        return $query->where('do_not_contact', 1);
    }

    /**
     * Filter talents WITHOUT DND enabled
     *
     */
    public function scopeWithoutDnd(Builder $query)
    {
        return $query->where('do_not_contact', 0);
    }

    /**
     * Filter talents with complete profiles
     *
     */
    public function scopeComplete(Builder $query)
    {
        return $query->where('completeness', 100);
    }

    /**
     * Filter talents with INcomplete profiles
     *
     */
    public function scopeIncomplete(Builder $query)
    {
        return $query->where('completeness', '<', 100)->orWhereNull('completeness');
    }

    /**
     * A talent has one citizenship
     *
     */
    public function citizenship() : HasOne
    {
        return $this->hasOne(Country::class, 'id', 'nationality');
    }

    /**
     * A talent has many resumes
     *
     */
    public function resumes() : HasMany
    {
        return $this->hasMany(Resume::class);
    }

    /**
     * A talent has one country
     *
     */
    public function country() : HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * A talent has many skills
     *
     *
     * @return
     */
    public function skills() : HasMany
    {
        return $this->hasMany(TalentSkill::class)->orderByDesc('is_primary', 'is_secondary');
    }

    /**
     * A talent belongs to one title
     *
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title() : BelongsTo
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * A talent belongs to one nationality country
     *
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nationalityCountry() : BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality', 'id');
    }

    /**
     * A talent belongs to one gender
     *
     */
    public function gender() : BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * A talent's vetting stages
     *
     */
    public function vettingStages() : hasMany
    {
        return $this->hasMany(TalentVetting::class);
    }

    /**
     * A talent's current (latest) vetting stage
     *
     */
    public function currentVettingStage() : hasOne
    {
        return $this->hasOne(TalentVetting::class)->latestOfMany('created_at');
    }

    /**
     * Return a talent's first name and last name
     *
     */
    public function getFullNameAttribute() : string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Return a talent's primary skills count
     *
     */
    public function getPrimarySkillsCountAttribute() : int
    {
        return $this->skills()->primary()->count();
    }

    /**
     * Return a talent's primary skills count
     *
     */
    public function getSecondarySkillsCountAttribute() : int
    {
        return $this->skills()->secondary()->count();
    }

    /**
     * Return a talent's first name and last name initials
     *
     */
    public function getInitialsAttribute() : string
    {
        $initials = '';

        if ($this->first_name) {
            $initials .= strtoupper("{$this->first_name[0]}.");
        }

        if ($this->last_name) {
            $initials .= strtoupper("{$this->last_name[0]}.");
        }

        return $initials;
    }

    /**
     * Does this talent have their data cached?
     *
     */
    public function getHasCachedDataAttribute() : bool
    {
        return Cache::has(config('resume.talent_data_cache_prefix') . $this->id);
    }

    /**
     * Does this talent have their education data cached?
     *
     */
    public function getHasCachedEducationDataAttribute() : bool
    {
        return Cache::has(config('resume.educations_data_cache_prefix') . $this->id);
    }

    /**
     * Does this talent have their experiences data cached?
     *
     */
    public function getHasCachedExperiencesDataAttribute() : bool
    {
        return Cache::has(config('resume.experiences_data_cache_prefix') . $this->id);
    }

    /**
     * Does this talent have their skills data cached?
     *
     */
    public function getHasCachedSkillsDataAttribute() : bool
    {
        return Cache::has(config('resume.skills_data_cache_prefix') . $this->id);
    }

    /**
     * Does this talent have their tools data cached?
     *
     */
    public function getHasCachedToolsDataAttribute() : bool
    {
        return Cache::has(config('resume.tools_data_cache_prefix') . $this->id);
    }

    /**
     * Get the talent's referrer
     *
     */
    public function referrer() : BelongsTo
    {
        return $this->belongsTo(Talent::class, 'referrer_id', 'id');
    }

    /**
     * Get the talent's state
     *
     */
    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the talent's job status
     *
     */
    public function jobStatus() : BelongsTo
    {
        return $this->belongsTo(JobStatus::class);
    }

    /**
     * Get the talent's salary currency
     *
     */
    public function salaryCurrency() : BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the talent's educations
     *
     */
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the talent's experiences
     *
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get the talent's languages
     *
     */
    public function languages()
    {
        return $this->hasMany(TalentLanguage::class);
    }

    /**
     * Get the talent's notice period
     *
     */
    public function noticePeriod()
    {
        return $this->belongsTo(NoticePeriod::class);
    }

    /**
     * Get the talent's job preference (remote_type)
     *
     */
    public function remoteType()
    {
        return $this->belongsTo(RemoteType::class);
    }

    /**
     * Convert the talent's salary to CAD, rounded up to the nearest 100
     *
     */
    public function salaryInCad() : ?int
    {
        if (! $this->attributes['salary']) {
            return null;
        }

        $rate = Forex::whereFromCurrency($this->attributes['salary_currency_id'])
            ->whereToCurrency('CAD')
            ->value('value');

        if (! $rate) {
            return null;
        }

        return (int) ceil(($this->attributes['salary'] * $rate) / 100) * 100;
    }

    /**
     * Get the talent's culture fit options
     *
     */
    public function cultureFit()
    {
        return $this->belongsToMany(CultureFit::class, 'talent_culture_fits');
    }

    /**
     * Get talent's data cached
     *
     */
    public function getCachedData() : array
    {
        return Cache::get(config('resume.talent_data_cache_prefix') . $this->id, []);
    }

    /**
     * Does this talent have their education data cached?
     *
     */
    public function getCachedEducationData() : array
    {
        return Cache::get(config('resume.educations_data_cache_prefix') . $this->id, []);
    }

    /**
     * Does this talent have their experiences data cached?
     *
     */
    public function getCachedExperiencesData() : array
    {
        return Cache::get(config('resume.experiences_data_cache_prefix') . $this->id, []);
    }

    /**
     * Does this talent have their skills data cached?
     *
     */
    public function getCachedSkillsData() : array
    {
        return Cache::get(config('resume.skills_data_cache_prefix') . $this->id, []);
    }

    /**
     * Get the talent's culture fit choices, grouped by category
     *
     */
    public function cultureFitCategoryChoices() : ?array
    {
        return $this->cultureFit()
            ->selectRaw('GROUP_CONCAT(culture_fit_id) AS choices, category_id')
            ->groupBy('category_id')
            ->pluck('choices', 'category_id')
            ->toArray();
    }

    /**
     * Calculate and update a talent's profile completeness
     *
     * @param bool $return_missing_fields Whether to return the missing fields
     * 
     *
     * @return araray
     */
    public function updateProfileCompleteness(bool $return_missing_fields = false) : array
    {
        $required_fields = [
            'first_name',
            'last_name',
            'title_id',
            'email',
            'job_status_id',
            'notice_period_id',
            'salary_currency_id',
            'min_salary',
            'phone',
            'linkedin',
            'nationality',
            'country_id',
            'state_id',
            'notice_period_id',
            'title_start_date',
        ];

        $required_relationships = [
            'resumes',
            'educations',
            'experiences',
            'skills',
            'languages',
        ];

        $culture_fit_category_limits = CultureFitCategory::pluck('max_choices', 'id')->toArray();

        $total_points = count($required_fields) + count($required_relationships);

        $completeness = 0;

        $missing = [];

        foreach ($required_fields as $field) {
            if (!is_null($this->$field)) {
                $completeness++;
            } else {
                $missing[] = $field;
            }
        }

        foreach ($required_relationships as $relationship) {
            if ($this->$relationship()->count()) {
                $completeness++;
            } else {
                $missing[] = "{$relationship}()";
            }
        }

        $culture_fit_per_category = $this->cultureFit->groupBy('category_id')->map(function ($fit) {
            return count($fit);
        })->toArray();

        foreach ($culture_fit_category_limits as $category_id => $limit) {
            if (isset($culture_fit_per_category[$category_id]) && $culture_fit_per_category[$category_id] == $limit) {
                $completeness++;
            } else {
                $missing[] = "culture_fit:category_{$category_id}";
            }

            $total_points++;
        }

        $this->addData('completeness', $percent = (int) round($completeness / $total_points * 100));

        $return = [ 'percent' => $percent ];

        if ($return_missing_fields) {
            $return['missing'] = $missing;
        }

        return $return;
    }
}
