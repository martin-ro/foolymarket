<?php

namespace App\Filament\Resources\States;

use App\Filament\Clusters\System\SystemCluster;
use App\Filament\Resources\States\Pages\ListStates;
use App\Filament\Resources\States\Tables\StatesTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\State;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class StateResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = State::class;

    protected static ?string $cluster = SystemCluster::class;

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
