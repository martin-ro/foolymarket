<?php

namespace App\Models\Traits;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasVenues
{
    /**
     * @return HasMany<Venue, $this>
     */
    public function venues(): HasMany
    {
        return $this->hasMany(Venue::class);
    }
}
