<?php

namespace App\Filament\Resources\Leagues;

use App\Filament\Clusters\Football\FootballCluster;
use App\Filament\Resources\Leagues\Pages\ListLeagues;
use App\Filament\Resources\Leagues\Tables\LeaguesTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\League;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class LeagueResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = League::class;

    protected static ?string $cluster = FootballCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::List;

    protected static ?int $navigationSort = 0;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return LeaguesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeagues::route('/'),
        ];
    }
}
