<?php

namespace App\Filament\Resources\Venues;

use App\Filament\Clusters\Locations\LocationsCluster;
use App\Filament\Resources\Venues\Pages\ListVenues;
use App\Filament\Resources\Venues\Tables\VenuesTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Venue;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class VenueResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Venue::class;

    protected static ?string $cluster = LocationsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::BuildingStadium;

    protected static ?int $navigationSort = 0;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return VenuesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVenues::route('/'),
        ];
    }
}
