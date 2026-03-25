<?php

namespace App\Models\Traits;

use App\Models\State;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasState
{
    /**
     * @return BelongsTo<State, $this>
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
