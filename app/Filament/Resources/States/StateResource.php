<?php

namespace App\Filament\Resources\States;

use App\Filament\Resources\States\Pages\ListStates;
use App\Filament\Resources\States\Tables\StatesTable;
use App\Models\State;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Other';

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return StatesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStates::route('/'),
        ];
    }
}
