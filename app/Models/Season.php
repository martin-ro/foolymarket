<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    use SoftDeletes;

    protected $casts = [
        'finished' => 'boolean',
        'pending' => 'boolean',
        'is_current' => 'boolean',
        'starting_at' => 'date',
        'ending_at' => 'date',
        'standings_recalculated_at' => 'datetime',
        'games_in_current_week' => 'boolean',
    ];

    /**
     * @return BelongsTo<League, $this>
     */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function tieBreakerRule(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'tie_breaker_rule_id');
    }
}
