<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class ToggleableTextColumn
{
    public static function make(string $name): TextColumn
    {
        return TextColumn::make($name)
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
