<?php

namespace App\Models\Traits;

use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTeam
{
    /**
     * @return BelongsTo<Team, $this>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
