<?php

namespace App\Models;

use App\Models\Traits\HasLeague;
use App\Models\Traits\HasSeason;
use App\Models\Traits\HasState;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fixture extends Model
{
    use HasLeague, HasSeason, HasState, SoftDeletes;

    protected $casts = [
        'starting_at' => 'datetime',
        'placeholder' => 'boolean',
        'has_odds' => 'boolean',
        'has_premium_odds' => 'boolean',
    ];

    /**
     * @return BelongsTo<Stage, $this>
     */
    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    /**
     * @return BelongsTo<Round, $this>
     */
    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    /**
     * @return BelongsTo<Venue, $this>
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * @return HasMany<Score, $this>
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    /**
     * @return Attribute<string|null, never>
     */
    protected function finalScore(): Attribute
    {
        return Attribute::get(function (): ?string {
            $scores = $this->scores ?? $this->scores()->get();

            if ($scores->isEmpty()) {
                return null;
            }

            $priority = ['CURRENT', '2ND_HALF', '1ST_HALF'];
            $home = null;
            $away = null;

            foreach ($priority as $period) {
                foreach ($scores as $score) {
                    if ($score->description !== $period) {
                        continue;
                    }

                    $participant = $score->score['participant'] ?? null;

                    if ($participant === 'home' && $home === null) {
                        $home = $score->score['goals'] ?? 0;
                    } elseif ($participant === 'away' && $away === null) {
                        $away = $score->score['goals'] ?? 0;
                    }
                }

                if ($home !== null && $away !== null) {
                    break;
                }
            }

            if ($home === null && $away === null) {
                return null;
            }

            return ($home ?? 0).' - '.($away ?? 0);
        });
    }
}
