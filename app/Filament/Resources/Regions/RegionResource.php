<?php

namespace App\Filament\Resources\Regions;

use App\Filament\Clusters\Locations\LocationsCluster;
use App\Filament\Resources\Regions\Pages\ListRegions;
use App\Filament\Resources\Regions\Tables\RegionsTable;
use App\Models\Region;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $cluster = LocationsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::Map;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return RegionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegions::route('/'),
        ];
    }
}
