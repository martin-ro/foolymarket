<?php

namespace App\Models;

use Database\Factories\StageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stage extends Model
{
    /** @use HasFactory<StageFactory> */
    use HasFactory;

    protected $casts = [
        'sort_order' => 'integer',
        'finished' => 'boolean',
        'is_current' => 'boolean',
        'starting_at' => 'date',
        'ending_at' => 'date',
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
     * @return BelongsTo<Season, $this>
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function tieBreakerRule(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'tie_breaker_rule_id');
    }
}
