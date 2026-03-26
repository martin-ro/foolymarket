<?php

namespace App\Filament\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;

class LeagueFilter
{
    public static function make(string $name = 'league'): SelectFilter
    {
        return SelectFilter::make($name)
            ->label('League')
            ->relationship($name, 'name')
            ->searchable()
            ->multiple()
            ->preload();
    }
}
