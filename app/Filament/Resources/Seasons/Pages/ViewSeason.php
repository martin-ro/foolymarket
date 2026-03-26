<?php

namespace App\Filament\Resources\Seasons\Pages;

use App\Filament\Resources\Seasons\SeasonResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewSeason extends ViewRecord
{
    protected static string $resource = SeasonResource::class;

    public function getTitle(): string|Htmlable
    {
        return "{$this->record->league->name} {$this->record->name}";
    }
}
