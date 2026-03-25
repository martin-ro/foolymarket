<?php

namespace App\Filament\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;

class StateFilter
{
    public static function make(string $name = 'state'): SelectFilter
    {
        return SelectFilter::make($name)
            ->relationship($name, 'name')
            ->searchable()
            ->multiple()
            ->preload();
    }
}
