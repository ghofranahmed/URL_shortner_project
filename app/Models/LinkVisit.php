<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkVisit extends Model
{
    protected $fillable = ['short_link_id', 'ip_address', 'user_agent']; 
    public function shortLink() { 
        return $this->belongsTo(ShortLink::class); 
    }
}
