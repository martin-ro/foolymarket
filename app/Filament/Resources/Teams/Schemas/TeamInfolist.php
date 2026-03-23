<?php

namespace App\Filament\Resources\Teams\Schemas;

use App\Models\Team;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TeamInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('sport_id')
                    ->numeric(),
                TextEntry::make('country.name')
                    ->label('Country'),
                TextEntry::make('venue_id')
                    ->numeric(),
                TextEntry::make('gender'),
                TextEntry::make('name'),
                TextEntry::make('short_code')
                    ->placeholder('-'),
                ImageEntry::make('image_path')
                    ->placeholder('-'),
                TextEntry::make('founded')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('type'),
                IconEntry::make('placeholder')
                    ->boolean(),
                TextEntry::make('last_played_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Team $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
