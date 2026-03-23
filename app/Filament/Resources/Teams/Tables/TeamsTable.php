<?php

namespace App\Filament\Resources\Teams\Tables;

use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Logo'),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Medium)
                    ->grow(),
                TextColumn::make('country.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_played_at')
                    ->dateTime()
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
            ])
            ->filters([
                SelectFilter::make('country')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->multiple()
                    ->preload(),
            ]);
    }
}
