<?php

namespace App\Filament\Resources\PersonalResource\Pages;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PersonalResource;
use App\Models\Personal\Categoria;
use App\Models\Personal\Sexo;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonals extends ListRecords
{
    protected static string $resource = PersonalResource::class;

    protected static ?string $title = 'Personales';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Resgistrar Personal'),
        ];
    }

    public function getTabs(): array
    {
        // Obtener los IDs de categorías y sexos en una sola consulta
        $categorias = Categoria::whereIn('categoria', ['COMBATIENTE', 'ACTIVO'])
            ->pluck('idpersonal_categorias', 'categoria')
            ->toArray();

        $sexos = Sexo::whereIn('sexo', ['MASCULINO', 'FEMENINO'])
            ->pluck('idpersonal_sexo', 'sexo')
            ->toArray();

        return [
            'todos' => Tab::make(),
            'categoria_combatiente' => Tab::make()->label('Cat: Combatiente')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('categoria_id', $categorias['COMBATIENTE'])),
            'categoria_activo' => Tab::make()->label('Cat: Activo')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('categoria_id', $categorias['ACTIVO'])),
            'sexo_masculino' => Tab::make()->label('Masculino')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('sexo_id', $sexos['MASCULINO'])),
            'sexo_femenino' => Tab::make()->label('Femenino')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('sexo_id', $sexos['FEMENINO'])),
        ];
    }
}
