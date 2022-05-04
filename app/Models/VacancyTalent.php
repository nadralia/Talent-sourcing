<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyTalent extends Model
{
    use HasFactory;
    use SoftDeletes;
                                 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'talent_id',
        'vacancy_id',
        'resume_id',
    ];
}
