<?php

namespace App\Models\Traits;

use App\Models\City;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCity
{
    /**
     * @return BelongsTo<City, $this>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
