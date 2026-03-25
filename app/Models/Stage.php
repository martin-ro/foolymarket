<?php

namespace App\Models;

use App\Models\Traits\HasLeague;
use App\Models\Traits\HasSeason;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stage extends Model
{
    use HasLeague, HasSeason, SoftDeletes;

    protected $casts = [
        'finished' => 'boolean',
        'is_current' => 'boolean',
        'starting_at' => 'date',
        'ending_at' => 'date',
        'games_in_current_week' => 'boolean',
    ];

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
