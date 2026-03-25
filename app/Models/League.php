<?php

namespace App\Models;

use App\Models\Traits\HasCountry;
use App\Models\Traits\HasSport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class League extends Model
{
    use HasCountry, HasSport, SoftDeletes;

    protected $casts = [
        'active' => 'boolean',
        'has_jerseys' => 'boolean',
        'last_played_at' => 'datetime',
    ];
}
