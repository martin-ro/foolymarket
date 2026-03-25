<?php

namespace App\Filament\Resources\States\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                NameColumn::make(),
                TextColumn::make('state'),
                TextColumn::make('short_name'),
                TextColumn::make('developer_name'),
                ...TimeStampColumns::make(),
            ]);
    }
}
