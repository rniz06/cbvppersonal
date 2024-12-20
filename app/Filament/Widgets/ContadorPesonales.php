<?php

namespace App\Filament\Widgets;

use App\Models\Vistas\VtPersonal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContadorPesonales extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Registros', VtPersonal::query()->count()),
            Stat::make('Categoria Activo', VtPersonal::query()->where('estado', 'ACTIVO')->where('categoria', 'ACTIVO')->count()),
            Stat::make('Categoria Combatiente', VtPersonal::query()->where('estado', 'ACTIVO')->where('categoria', 'COMBATIENTE')->count()),
        ];
    }
}
