<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class CreatedAtColumn
{
    public static function make(): TextColumn
    {
        return TextColumn::make('created_at')
            ->label('Created')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
