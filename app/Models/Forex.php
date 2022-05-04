<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forex extends Model
{
    use HasFactory;

    protected $table = 'forex';
    protected $casts = [ 'from_currency' => 'string', 'to_currency' => 'string' ];

    protected $fillable = [
        'from_currency',
        'to_currency'
     ];
}
