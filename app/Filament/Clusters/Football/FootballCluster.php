<?php

namespace App\Filament\Clusters\Football;

use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use UnitEnum;

class FootballCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = TablerIcon::BallFootball;

    protected static string|UnitEnum|null $navigationGroup = 'Data';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?int $navigationSort = 0;
}
