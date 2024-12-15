<?php

namespace App\Filament\Resources\PersonalResource\Pages;

use App\Filament\Resources\PersonalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonal extends CreateRecord
{
    protected static string $resource = PersonalResource::class;

    protected static ?string $title = 'Resgistrar Personal';

    protected function getRedirectUrl(): string
    {
        return PersonalResource::getUrl('index');
    }
}
