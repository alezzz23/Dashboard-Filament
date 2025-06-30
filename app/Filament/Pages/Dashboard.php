<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\InscripcionesStatsWidget;
use App\Filament\Widgets\LatestInscripcionesWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static string $view = 'filament.pages.dashboard';
    
    public function getWidgets(): array
    {
        return [
            InscripcionesStatsWidget::class,
            LatestInscripcionesWidget::class,
        ];
    }
    
    public function getColumns(): int|string|array
    {
        return 1;
    }
    
    public function getTitle(): string
    {
        return 'Panel de Control';
    }
}
