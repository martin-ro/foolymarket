<?php

namespace App\Filament\Resources\Bookmakers;

use App\Filament\Resources\Bookmakers\Pages\ListBookmakers;
use App\Filament\Resources\Bookmakers\Tables\BookmakersTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Bookmaker;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookmakerResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Bookmaker::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return BookmakersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookmakers::route('/'),
        ];
    }
}
