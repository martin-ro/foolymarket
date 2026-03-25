<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasCountry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasCity, HasCountry, SoftDeletes;

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * @return BelongsTo<Country, $this>
     */
    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'position_id');
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function detailedPosition(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'detailed_position_id');
    }

    /**
     * @return BelongsTo<Type, $this>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
