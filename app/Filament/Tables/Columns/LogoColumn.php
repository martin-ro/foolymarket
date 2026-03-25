<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\ImageColumn;

class LogoColumn
{
    public static function make(string $name = 'image_path'): ImageColumn
    {
        return ImageColumn::make($name)
            ->label(false)
            ->toggleable()
            ->circular()
            ->imageHeight(25);
    }
}
