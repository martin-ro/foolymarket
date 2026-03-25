<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasCountry;
use App\Models\Traits\HasSport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referee extends Model
{
    use HasCity, HasCountry, HasSport, SoftDeletes;

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
