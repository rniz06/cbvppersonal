<?php

namespace App\Filament\Resources\UsuarioResource\Pages;

use App\Filament\Resources\UsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsuarios extends ListRecords
{
    protected static string $resource = UsuarioResource::class;

    protected static ?string $title = 'Usuarios';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Añadir Usuario'),
        ];
    }
}
