<?php

namespace App\Filament\Resources\Seasons;

use App\Filament\Clusters\Football\FootballCluster;
use App\Filament\Resources\Seasons\Pages\ListSeasons;
use App\Filament\Resources\Seasons\Tables\SeasonsTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Season;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class SeasonResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Season::class;

    protected static ?string $cluster = FootballCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::CalendarWeek;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return SeasonsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSeasons::route('/'),
        ];
    }
}
