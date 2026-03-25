<?php

namespace App\Filament\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;

class TeamFilter
{
    public static function make(string $name = 'team'): SelectFilter
    {
        return SelectFilter::make($name)
            ->relationship($name, 'name')
            ->searchable()
            ->multiple()
            ->preload();
    }
}
