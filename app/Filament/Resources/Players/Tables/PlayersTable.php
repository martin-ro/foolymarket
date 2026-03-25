<?php

namespace App\Filament\Resources\Players\Tables;

use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\PhotoColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use App\Filament\Tables\Columns\ToggleableTextColumn;
use App\Filament\Tables\Filters\CountryFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlayersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                PhotoColumn::make(),
                NameColumn::make(),
                ToggleableTextColumn::make('common_name'),
                TextColumn::make('nationality.name'),
                TextColumn::make('position.name')
                    ->placeholder('—'),
                TextColumn::make('type.name'),
                ...TimeStampColumns::make(),
            ])
            ->filters([
                CountryFilter::make('nationality'),
            ]);
    }
}
