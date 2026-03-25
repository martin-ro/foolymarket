<?php

namespace App\Filament\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;

class CountryFilter
{
    public static function make(string $name = 'country'): SelectFilter
    {
        return SelectFilter::make($name)
            ->relationship($name, 'name')
            ->searchable()
            ->multiple()
            ->preload();
    }
}
