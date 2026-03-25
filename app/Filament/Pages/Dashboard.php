<?php

namespace App\Filament\Pages;

use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = TablerIcon::Home;

    protected string $view = 'filament.pages.dashboard';
}
