<?php

namespace App\Filament\Resources\Leagues\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\LogoColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeAgoColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeaguesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                LogoColumn::make(),
                NameColumn::make(),
                TextColumn::make('country.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TimeAgoColumn::make('last_played_at'),
                ...TimeStampColumns::make(),
            ]);
    }
}
