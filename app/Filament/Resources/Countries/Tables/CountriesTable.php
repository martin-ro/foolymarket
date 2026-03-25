<?php

namespace App\Filament\Resources\Countries\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\LogoColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Table;

class CountriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                LogoColumn::make(),
                NameColumn::make()->grow(),
                ...TimeStampColumns::make(),
            ]);
    }
}
