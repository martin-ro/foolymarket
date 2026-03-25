<?php

namespace App\Filament\Resources\Cities;

use App\Filament\Clusters\Locations\LocationsCluster;
use App\Filament\Resources\Cities\Pages\ListCities;
use App\Filament\Resources\Cities\Tables\CitiesTable;
use App\Models\City;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $cluster = LocationsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::Buildings;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return CitiesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCities::route('/'),
        ];
    }
}
