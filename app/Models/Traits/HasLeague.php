<?php

namespace App\Models\Traits;

use App\Models\League;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasLeague
{
    /**
     * @return BelongsTo<League, $this>
     */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }
}
