<?php

namespace App\Filament\Resources\Players\Schemas;

use App\Models\Player;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PlayerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('sport_id')
                    ->numeric(),
                TextEntry::make('country.name')
                    ->label('Country')
                    ->placeholder('-'),
                TextEntry::make('nationality.name')
                    ->label('Nationality')
                    ->placeholder('-'),
                TextEntry::make('city.id')
                    ->label('City')
                    ->placeholder('-'),
                TextEntry::make('position.name')
                    ->label('Position')
                    ->placeholder('-'),
                TextEntry::make('detailedPosition.name')
                    ->label('Detailed position')
                    ->placeholder('-'),
                TextEntry::make('type.name')
                    ->label('Type')
                    ->placeholder('-'),
                TextEntry::make('common_name')
                    ->placeholder('-'),
                TextEntry::make('firstname')
                    ->placeholder('-'),
                TextEntry::make('lastname')
                    ->placeholder('-'),
                TextEntry::make('name'),
                TextEntry::make('display_name'),
                ImageEntry::make('image_path')
                    ->placeholder('-'),
                TextEntry::make('height')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('weight')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('date_of_birth')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('gender')
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Player $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
