<?php

namespace App\Filament\Resources\Leagues\Schemas;

use App\Models\League;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LeagueInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('sport_id')
                    ->numeric(),
                TextEntry::make('country_id')
                    ->numeric(),
                TextEntry::make('name'),
                IconEntry::make('active')
                    ->boolean(),
                TextEntry::make('short_code')
                    ->placeholder('-'),
                ImageEntry::make('image_path')
                    ->placeholder('-'),
                TextEntry::make('type'),
                TextEntry::make('sub_type'),
                TextEntry::make('last_played_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('category')
                    ->numeric(),
                IconEntry::make('has_jerseys')
                    ->boolean(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (League $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
