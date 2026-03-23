<?php

namespace App\Models;

use Database\Factories\LeagueFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class League extends Model
{
    /** @use HasFactory<LeagueFactory> */
    use HasFactory;

    protected $casts = [
        'active' => 'boolean',
        'has_jerseys' => 'boolean',
        'last_played_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<Country, $this>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
