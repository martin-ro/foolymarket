<?php

namespace App\Filament\Resources\Regions\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Table;

class RegionsTable
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
