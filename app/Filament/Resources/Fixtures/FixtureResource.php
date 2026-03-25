<?php

namespace App\Filament\Resources\Fixtures;

use App\Filament\Resources\Fixtures\Pages\ListFixtures;
use App\Filament\Resources\Fixtures\Tables\FixturesTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Fixture;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class FixtureResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Fixture::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::SoccerField;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return FixturesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFixtures::route('/'),
        ];
    }
}
