<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class TimeAgoColumn
{
    public static function make(string $name): TextColumn
    {
        return TextColumn::make($name)
            ->dateTime()
            ->sortable()
            ->toggleable()
            ->since()
            ->tooltip(fn (Model $record): ?string => $record->{$name}->format('M j, Y H:i:s'));
    }
}
