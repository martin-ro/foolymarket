<?php

namespace App\Filament\Resources\Seasons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class SeasonsTable
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
                TextColumn::make('tieBreakerRule.name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                IconColumn::make('finished')
                    ->boolean(),
                IconColumn::make('pending')
                    ->boolean(),
                IconColumn::make('is_current')
                    ->boolean(),
                TextColumn::make('starting_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('ending_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('standings_recalculated_at')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('games_in_current_week')
                    ->boolean(),
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
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
