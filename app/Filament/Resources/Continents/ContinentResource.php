<?php

namespace App\Filament\Resources\Continents;

use App\Filament\Clusters\Locations\LocationsCluster;
use App\Filament\Resources\Continents\Pages\ListContinents;
use App\Filament\Resources\Continents\Tables\ContinentsTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Continent;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ContinentResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Continent::class;

    protected static ?string $cluster = LocationsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::WorldMap;

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return ContinentsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContinents::route('/'),
        ];
    }
}
