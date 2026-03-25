<?php

namespace App\Providers\Filament;

use AchyutN\FilamentLogViewer\FilamentLogViewer;
use App\Filament\Pages\Dashboard;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\BasePage;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ColumnManagerLayout;
use Filament\Tables\Table;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('/')
            ->viteTheme('resources/css/filament/app/theme.css')
            ->login()
            ->registration(false)
            ->passwordReset()
            ->colors([
                'primary' => Color::Sky,
                'gray' => Color::Slate,
            ])
            ->favicon(asset('favicon-32x32.png'))
            ->databaseNotifications()
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                NavigationGroup::make('Matches'),
                NavigationGroup::make('Data'),
                NavigationGroup::make('Other'),
                NavigationGroup::make('Admin'),
            ])
            ->navigationItems([
                NavigationItem::make('Horizon')
                    ->group('Admin')
                    ->url(url: config('app.url').'/horizon', shouldOpenInNewTab: true)
                    ->icon(TablerIcon::DatabaseImport),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverPages(in: app_path('Filament/Clusters'), for: 'App\Filament\Clusters')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                //
            ])
            ->plugins([
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled(app()->environment('local'))
                    ->users(['test' => 'test@example.com'])
                    ->switchable(false),

                FilamentLogViewer::make()
                    ->navigationGroup('Admin'),
            ])
            ->bootUsing(function (): void {
                Table::configureUsing(fn (Table $table): Table => $table->striped());
                Table::configureUsing(fn (Table $table): Table => $table->columnManagerLayout(ColumnManagerLayout::Modal));
                Table::configureUsing(fn (Table $table): Table => $table->columnManagerColumns(2));

                TextColumn::configureUsing(fn (TextColumn $column): TextColumn => $column
                    ->sortable()
                    ->searchable()
                );

                BasePage::alignFormActionsEnd();

                CreateAction::configureUsing(fn (Action $action): Action => $action->slideOver());
                EditAction::configureUsing(fn (Action $action): Action => $action->slideOver());
                ViewAction::configureUsing(fn (Action $action): Action => $action->slideOver());
            })
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
