<?php

namespace App\Filament\Resources\Types;

use App\Filament\Clusters\System\SystemCluster;
use App\Filament\Resources\Types\Pages\ListTypes;
use App\Filament\Resources\Types\Tables\TypesTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Type;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TypeResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Type::class;

    protected static ?string $cluster = SystemCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return TypesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTypes::route('/'),
        ];
    }
}
