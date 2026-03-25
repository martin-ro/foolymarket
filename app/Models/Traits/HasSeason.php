<?php

namespace App\Models\Traits;

use App\Models\Season;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasSeason
{
    /**
     * @return BelongsTo<Season, $this>
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
