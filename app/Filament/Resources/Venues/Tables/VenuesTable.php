<?php

namespace App\Filament\Resources\Venues\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\PhotoColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VenuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                PhotoColumn::make(),
                NameColumn::make()->grow(),
                TextColumn::make('country.name'),
                TextColumn::make('city.name'),
                TextColumn::make('capacity')
                    ->numeric(),
                ...TimeStampColumns::make(),
            ]);
    }
}
