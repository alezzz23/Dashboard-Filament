<?php

namespace App\Filament\Widgets;

use App\Models\Inscripcion;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InscripcionesStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $total = Inscripcion::count();
        $hoy = Inscripcion::whereDate('fecha_registro', today())->count();
        $semana = Inscripcion::where('fecha_registro', '>=', now()->subWeek())->count();
        $mes = Inscripcion::where('fecha_registro', '>=', now()->subMonth())->count();

        return [
            Stat::make('Total Inscripciones', $total)
                ->description('Inscripciones totales')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary'),
                
            Stat::make('Hoy', $hoy)
                ->description('Inscripciones de hoy')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
                
            Stat::make('Esta Semana', $semana)
                ->description('Inscripciones de los últimos 7 días')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('warning'),
                
            Stat::make('Este Mes', $mes)
                ->description('Inscripciones de los últimos 30 días')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('info'),
        ];
    }

    public static function canView(): bool
    {
        return true;
    }
}
