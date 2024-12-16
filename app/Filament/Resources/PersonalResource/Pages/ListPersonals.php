<?php

namespace App\Filament\Resources\PersonalResource\Pages;

use App\Filament\Resources\PersonalResource;
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
}
