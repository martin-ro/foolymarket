<?php

namespace App\Models\Traits;

use App\Models\Sport;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasSport
{
    /**
     * @return BelongsTo<Sport, $this>
     */
    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }
}
