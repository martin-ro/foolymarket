<?php

namespace App\Models;

use App\Models\Traits\HasTeam;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rival extends Pivot
{
    use HasTeam, SoftDeletes;

    protected $table = 'rivals';

    public $incrementing = true;

    /**
     * @return BelongsTo<Team, $this>
     */
    public function rival(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'rival_id');
    }
}
