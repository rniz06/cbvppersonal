<?php

namespace App\Filament\Resources\UsuarioResource\Pages;

use App\Filament\Resources\UsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsuario extends EditRecord
{
    protected static string $resource = UsuarioResource::class;

    protected static ?string $title = 'Editar Usuario';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return UsuarioResource::getUrl('index');
    }
}
