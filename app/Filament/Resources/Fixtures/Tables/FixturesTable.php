<?php

namespace App\Filament\Resources\Fixtures\Tables;

use App\Filament\Tables\Columns\DateTimeColumn;
use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use App\Filament\Tables\Columns\ToggleableTextColumn;
use App\Filament\Tables\Filters\CountryFilter;
use App\Filament\Tables\Filters\LeagueFilter;
use App\Filament\Tables\Filters\StateFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FixturesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('starting_at_timestamp')
            ->columns([
                IdColumn::make(),
                NameColumn::make(),
                ToggleableTextColumn::make('round.name'),
                ToggleableTextColumn::make('round.id'),
                TextColumn::make('final_score')
                    ->sortable(false),
                TextColumn::make('state.name'),
                DateTimeColumn::make('starting_at_timestamp'),
                ...TimeStampColumns::make(),
            ])
            ->filters([
                StateFilter::make(),
                LeagueFilter::make(),
                CountryFilter::make('league.country'),
            ]);
    }
}
