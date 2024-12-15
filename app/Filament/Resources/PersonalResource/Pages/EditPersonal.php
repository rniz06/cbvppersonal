<?php

namespace App\Filament\Resources\PersonalResource\Pages;

use App\Filament\Resources\PersonalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonal extends EditRecord
{
    protected static string $resource = PersonalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected static ?string $title = 'Editar Personal';

    protected function getRedirectUrl(): string
    {
        return PersonalResource::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['nombrecompleto'] = $data['apellidos'] . ' ' . ',' . ' ' . $data['nombres'];

        return $data;
    }
}
