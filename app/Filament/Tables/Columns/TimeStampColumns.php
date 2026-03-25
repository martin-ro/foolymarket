<?php

namespace App\Filament\Tables\Columns;

class TimeStampColumns
{
    public static function make(): array
    {
        return [
            DeletedAtColumn::make(),
            CreatedAtColumn::make(),
            UpdatedAtColumn::make(),
        ];
    }
}
