<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    protected $fillable = [
        'original_url',
        'short_code',
        'visit_count',
    ];

    //
    public function visits()
    {
        return $this->hasMany(LinkVisit::class);
    }
}
