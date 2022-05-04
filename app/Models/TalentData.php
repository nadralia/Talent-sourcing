<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentData extends Model
{   
    protected $table = 'talent_data';
    protected $fillable = [
        'talent_id',
        'name',
        'value',
    ];
}
