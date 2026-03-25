<?php

namespace App\Filament\Resources\Teams;

use App\Filament\Clusters\Football\FootballCluster;
use App\Filament\Resources\Teams\Pages\ListTeams;
use App\Filament\Resources\Teams\Tables\TeamsTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Team;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Team::class;

    protected static ?string $cluster = FootballCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::ShieldChevron;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return TeamsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeams::route('/'),
        ];
    }
}
