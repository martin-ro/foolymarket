<?php

namespace App\Models;

use Database\Factories\ContinentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    /** @use HasFactory<ContinentFactory> */
    use HasFactory;
}
