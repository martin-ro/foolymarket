<?php

namespace App\Models;

use App\Models\Traits\HasLeague;
use App\Models\Traits\HasSeason;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Round extends Model
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
     * @return BelongsTo<Stage, $this>
     */
    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }
}
