<?php

namespace App\Filament\Resources\Bookmakers\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Table;

class BookmakersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                NameColumn::make(),
                ...TimeStampColumns::make(),
            ]);
    }
}
