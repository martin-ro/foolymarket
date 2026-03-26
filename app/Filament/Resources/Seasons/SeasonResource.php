<?php

namespace App\Filament\Resources\Seasons;

use App\Filament\Clusters\Football\FootballCluster;
use App\Filament\Resources\Seasons\Pages\ListSeasons;
use App\Filament\Resources\Seasons\Pages\ViewSeason;
use App\Filament\Resources\Seasons\RelationManagers\FixturesRelationManager;
use App\Filament\Resources\Seasons\Schemas\SeasonInfolist;
use App\Filament\Resources\Seasons\Tables\SeasonsTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Season;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class SeasonResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Season::class;

    protected static ?string $cluster = FootballCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::CalendarWeek;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getRecordTitle(?Model $record): string|Htmlable|null
    {
        return "{$record->league->name} {$record->name}";
    }

    public static function infolist(Schema $schema): Schema
    {
        return SeasonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeasonsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            FixturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSeasons::route('/'),
            'view' => ViewSeason::route('/{record}'),
        ];
    }
}
