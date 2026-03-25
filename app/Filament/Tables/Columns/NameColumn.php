<?php

namespace App\Filament\Tables\Columns;

use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;

class NameColumn
{
    public static function make(string $name = 'name'): TextColumn
    {
        return TextColumn::make($name)
            ->searchable()
            ->sortable()
            ->weight(FontWeight::Medium)
            ->grow();
    }
}
