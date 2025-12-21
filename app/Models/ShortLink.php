<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortLink extends Model
{ protected $fillable = [
        'original_url',  
        'short_code',     
        'visit_count'     
    ];
    //
    public function visits()
{
    return $this->hasMany(LinkVisit::class);
}

}
