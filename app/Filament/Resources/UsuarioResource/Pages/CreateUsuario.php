<?php

namespace App\Filament\Resources\UsuarioResource\Pages;

use App\Filament\Resources\UsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUsuario extends CreateRecord
{
    protected static string $resource = UsuarioResource::class;

    protected static ?string $title = 'Crear Usuario';

    protected function getRedirectUrl(): string
    {
        return UsuarioResource::getUrl('index');
    }
}
