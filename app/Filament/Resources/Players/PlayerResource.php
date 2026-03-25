<?php

namespace App\Filament\Resources\Players;

use App\Filament\Clusters\Football\FootballCluster;
use App\Filament\Resources\Players\Pages\ListPlayers;
use App\Filament\Resources\Players\Tables\PlayersTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Player;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class PlayerResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Player::class;

    protected static ?string $cluster = FootballCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::PlayFootball;

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'display_name';

    public static function table(Table $table): Table
    {
        return PlayersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlayers::route('/'),
        ];
    }
}
