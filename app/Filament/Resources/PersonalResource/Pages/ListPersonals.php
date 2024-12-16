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
        // Obtener id de la categoria "COMBATIENTE"
        $id_cat_combatiente = Categoria::where('categoria', 'COMBATIENTE')->first();

        // Obtener id de la categoria "ACTIVO"
        $id_cat_activo = Categoria::where('categoria', 'ACTIVO')->first();

        // Obtener id de la sexo "MASCULINO"
        $id_sexo_masculino = Sexo::where('sexo', 'MASCULINO')->first();

        // Obtener id de la sexo "FEMENINO"
        $id_sexo_femenino = Sexo::where('sexo', 'FEMENINO')->first();

        return [
            'todos' => Tab::make(),
            'categoria_combatiente' => Tab::make()->label('Cat: Combatiente')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('categoria_id', $id_cat_combatiente->idpersonal_categorias)),
            'categoria_activo' => Tab::make()->label('Cat: Activo')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('categoria_id', $id_cat_activo->idpersonal_categorias)),
            'sexo_masculino' => Tab::make()->label('Masculino')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('sexo_id', $id_sexo_masculino->idpersonal_sexo)),
            'sexo_femenino' => Tab::make()->label('Femenino')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('sexo_id', $id_sexo_femenino->idpersonal_sexo)),
        ];
    }
}
