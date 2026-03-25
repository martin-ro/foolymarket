<?php

namespace App\Filament\Resources\TeamSquads\Tables;

use App\Filament\Tables\Columns\LogoColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\PhotoColumn;
use App\Filament\Tables\Filters\TeamFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamSquadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultGroup('team.name')
            ->groups([
                'team.name',
                'position.name',
            ])
            ->columns([
                PhotoColumn::make('player.image_path'),
                NameColumn::make('player.display_name'),
                LogoColumn::make('team.image_path'),
                NameColumn::make('team.name'),
                TextColumn::make('position.name'),
                TextColumn::make('jersey_number')
                    ->label('#'),
            ])
            ->filters([
                TeamFilter::make(),
            ]);
    }
}
