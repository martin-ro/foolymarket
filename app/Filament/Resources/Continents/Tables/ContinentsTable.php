<?php

namespace App\Filament\Resources\Continents\Tables;

use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContinentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                NameColumn::make(),
                TextColumn::make('code'),
                ...TimeStampColumns::make(),
            ]);
    }
}
