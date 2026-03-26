<?php

namespace App\Filament\Resources\Seasons\RelationManagers;

use App\Filament\Resources\Fixtures\FixtureResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class FixturesRelationManager extends RelationManager
{
    protected static string $relationship = 'fixtures';

    protected static ?string $relatedResource = FixtureResource::class;

    public function table(Table $table): Table
    {
        return $table;
    }
}
