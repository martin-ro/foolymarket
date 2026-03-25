<?php

namespace App\Filament\Resources\Teams\Tables;

use App\Filament\Tables\Columns\LogoColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeAgoColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use App\Filament\Tables\Filters\CountryFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->groups([
                'country.name',
            ])
            ->columns([
                LogoColumn::make(),
                NameColumn::make(),
                TextColumn::make('country.name'),
                TimeAgoColumn::make('last_played_at'),
                ...TimeStampColumns::make(),
            ])
            ->filters([
                CountryFilter::make(),
            ]);
    }
}
