<?php

namespace App\Filament\Resources\PersonalResource\Pages;

use App\Filament\Resources\PersonalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonal extends CreateRecord
{
    protected static string $resource = PersonalResource::class;

    protected static ?string $title = 'Registrar Personal';

    protected function getRedirectUrl(): string
    {
        return PersonalResource::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['ultima_actualizacion'] = now();

        $data['estado_actualizar_id'] = 2;

        return $data;
    }
}
