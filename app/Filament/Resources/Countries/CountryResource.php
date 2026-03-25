<?php

namespace App\Filament\Resources\Countries;

use App\Filament\Clusters\Locations\LocationsCluster;
use App\Filament\Resources\Countries\Pages\ListCountries;
use App\Filament\Resources\Countries\Tables\CountriesTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Country;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Country::class;

    protected static ?string $cluster = LocationsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::Flag;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return CountriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCountries::route('/'),
        ];
    }
}
