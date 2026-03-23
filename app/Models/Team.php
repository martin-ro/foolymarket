<?php

namespace App\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    /** @use HasFactory<TeamFactory> */
    use HasFactory;

    protected $casts = [
        'placeholder' => 'boolean',
        'last_played_at' => 'datetime',
        'founded' => 'integer',
    ];

    /**
     * @return BelongsTo<Country, $this>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

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
