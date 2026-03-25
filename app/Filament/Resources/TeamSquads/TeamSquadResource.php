<?php

namespace App\Filament\Resources\TeamSquads;

use App\Filament\Clusters\Football\FootballCluster;
use App\Filament\Resources\TeamSquads\Pages\ListTeamSquads;
use App\Filament\Resources\TeamSquads\Tables\TeamSquadsTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\TeamSquad;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TeamSquadResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = TeamSquad::class;

    protected static ?string $cluster = FootballCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::ShirtSport;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'player.display_name';

    public static function table(Table $table): Table
    {
        return TeamSquadsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeamSquads::route('/'),
        ];
    }
}
