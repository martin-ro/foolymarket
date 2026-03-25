<?php

namespace App\Models;

use App\Models\Traits\HasTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamSquad extends Model
{
    use HasTeam, SoftDeletes;

    protected $casts = [
        'captain' => 'boolean',
    ];

    /**
     * @return BelongsTo<Player, $this>
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'position_id');
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function detailedPosition(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'detailed_position_id');
    }
}
