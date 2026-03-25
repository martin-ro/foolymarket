<?php

namespace App\Models;

use App\Models\Traits\HasCountry;
use App\Models\Traits\HasSport;
use App\Models\Traits\HasVenues;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasCountry, HasSport, HasVenues, SoftDeletes;

    protected $casts = [
        'placeholder' => 'boolean',
        'last_played_at' => 'datetime',
        'founded' => 'integer',
    ];

    /**
     * @return BelongsToMany<Team, $this>
     */
    public function rivals(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'rivals', 'team_id', 'rival_id')
            ->using(Rival::class)
            ->withTimestamps();
    }
}
