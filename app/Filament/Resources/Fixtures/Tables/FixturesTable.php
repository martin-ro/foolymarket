<?php

namespace App\Filament\Resources\Fixtures\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FixturesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sport_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('league.name')
                    ->searchable(),
                TextColumn::make('season.name')
                    ->searchable(),
                TextColumn::make('stage.name')
                    ->searchable(),
                TextColumn::make('group_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aggregate_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('round_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('state.name')
                    ->searchable(),
                TextColumn::make('venue.name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('starting_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('result_info')
                    ->searchable(),
                TextColumn::make('leg')
                    ->searchable(),
                TextColumn::make('length')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('placeholder')
                    ->boolean(),
                IconColumn::make('has_odds')
                    ->boolean(),
                IconColumn::make('has_premium_odds')
                    ->boolean(),
                TextColumn::make('starting_at_timestamp')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
