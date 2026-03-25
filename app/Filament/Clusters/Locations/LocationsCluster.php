<?php

namespace App\Filament\Clusters\Locations;

use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use UnitEnum;

class LocationsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = TablerIcon::MapPin;

    protected static string|UnitEnum|null $navigationGroup = 'Data';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?int $navigationSort = 1;
}
