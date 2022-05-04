<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalentCultureFit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'talent_id',
        'culture_fit_id',
    ];

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
}
