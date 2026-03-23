<?php

namespace App\Filament\Resources\Fixtures\Schemas;

use App\Models\Fixture;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FixtureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('sport_id')
                    ->numeric(),
                TextEntry::make('league.name')
                    ->label('League')
                    ->placeholder('-'),
                TextEntry::make('season.name')
                    ->label('Season')
                    ->placeholder('-'),
                TextEntry::make('stage.name')
                    ->label('Stage')
                    ->placeholder('-'),
                TextEntry::make('group_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('aggregate_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('round_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('state.name')
                    ->label('State')
                    ->placeholder('-'),
                TextEntry::make('venue.name')
                    ->label('Venue')
                    ->placeholder('-'),
                TextEntry::make('name'),
                TextEntry::make('starting_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('result_info')
                    ->placeholder('-'),
                TextEntry::make('leg')
                    ->placeholder('-'),
                TextEntry::make('details')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('length')
                    ->numeric(),
                IconEntry::make('placeholder')
                    ->boolean(),
                IconEntry::make('has_odds')
                    ->boolean(),
                IconEntry::make('has_premium_odds')
                    ->boolean(),
                TextEntry::make('starting_at_timestamp')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Fixture $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
