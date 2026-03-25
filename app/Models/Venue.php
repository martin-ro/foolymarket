<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasCountry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasCity, HasCountry, SoftDeletes;

    protected $casts = [
        'national_team' => 'boolean',
    ];
}
