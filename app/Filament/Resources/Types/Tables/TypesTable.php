<?php

namespace App\Filament\Resources\Types\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Filament\Tables\Columns\TimeStampColumns;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                NameColumn::make(),
                TextColumn::make('code'),
                TextColumn::make('developer_name'),
                TextColumn::make('model_type'),
                TextColumn::make('stat_group'),
                ...TimeStampColumns::make(),
            ]);
    }
}
