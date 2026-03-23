<?php

namespace App\Models;

use Database\Factories\RivalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rival extends Pivot
{
    /** @use HasFactory<RivalFactory> */
    use HasFactory;

    protected $table = 'rivals';

    public $incrementing = true;

    /**
     * @return BelongsTo<Team, $this>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return BelongsTo<Team, $this>
     */
    public function rival(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'rival_id');
    }
}
