<?php

namespace App\Filament\Resources\Fixtures;

use App\Filament\Resources\Fixtures\Pages\ListFixtures;
use App\Filament\Resources\Fixtures\Pages\ViewFixture;
use App\Filament\Resources\Fixtures\Schemas\FixtureInfolist;
use App\Filament\Resources\Fixtures\Tables\FixturesTable;
use App\Models\Fixture;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FixtureResource extends Resource
{
    protected static ?string $model = Fixture::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function infolist(Schema $schema): Schema
    {
        return FixtureInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FixturesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFixtures::route('/'),
            'view' => ViewFixture::route('/{record}'),
        ];
    }
}
