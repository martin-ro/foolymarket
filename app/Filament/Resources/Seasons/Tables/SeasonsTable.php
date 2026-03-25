<?php

namespace App\Filament\Resources\Seasons\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\LogoColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeasonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('name', 'desc')
            ->columns([
                IdColumn::make(),
                LogoColumn::make('league.image_path'),
                NameColumn::make('league.name')
                    ->grow(false),
                NameColumn::make(),
                IconColumn::make('games_in_current_week')
                    ->label('Games this Week')
                    ->boolean(),
                TextColumn::make('standings_recalculated_at')
                    ->dateTime()
                    ->sortable(),
                ...TimeStampColumns::make(),
            ]);
    }
}
