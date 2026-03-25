<?php

namespace App\Filament\Resources\Continents\Pages;

use App\Filament\Resources\Continents\ContinentResource;
use Filament\Resources\Pages\ListRecords;

class ListContinents extends ListRecords
{
    protected static string $resource = ContinentResource::class;
}
