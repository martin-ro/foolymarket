<?php

namespace App\Filament\Resources\Markets;

use App\Filament\Clusters\System\SystemCluster;
use App\Filament\Resources\Markets\Pages\ListMarkets;
use App\Filament\Resources\Markets\Tables\MarketsTable;
use App\Filament\Traits\HasSoftDeletes;
use App\Models\Market;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class MarketResource extends Resource
{
    use HasSoftDeletes;

    protected static ?string $model = Market::class;

    protected static ?string $cluster = SystemCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return MarketsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMarkets::route('/'),
        ];
    }
}
