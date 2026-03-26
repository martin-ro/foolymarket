<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class IdColumn
{
    public static function make(string $name = 'id'): TextColumn
    {
        return TextColumn::make($name)
            ->label('ID')
            ->searchable()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: false);
    }
}
