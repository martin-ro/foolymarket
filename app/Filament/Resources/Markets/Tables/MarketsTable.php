<?php

namespace App\Filament\Resources\Markets\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MarketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                NameColumn::make(),
                TextColumn::make('developer_name'),
                IconColumn::make('has_winning_calculations')
                    ->boolean(),
                ...TimeStampColumns::make(),
            ]);
    }
}
