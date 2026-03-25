<?php

namespace App\Models;

use App\Models\Traits\HasCountry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasCountry, SoftDeletes;
}
