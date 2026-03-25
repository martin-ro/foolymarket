<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\ImageColumn;

class PhotoColumn
{
    public static function make(string $name = 'image_path'): ImageColumn
    {
        return ImageColumn::make($name)
            ->label('Photo')
            ->circular();
    }
}
