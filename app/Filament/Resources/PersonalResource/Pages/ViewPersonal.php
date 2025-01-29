<?php

namespace App\Filament\Resources\PersonalResource\Pages;

use App\Filament\Resources\PersonalResource;
use App\Livewire\Personal\Contacto as PersonalContacto;
use App\Livewire\Personal\Emergencia as PersonalEmergencia;
use App\Models\Ciudad;
use App\Models\Personal;
use App\Models\Personal\Contacto;
use App\Models\Personal\ContactoEmergencia;
use App\Models\Personal\Parentesco;
use App\Models\Personal\TipoContacto;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPersonal extends ViewRecord
{
    protected static string $resource = PersonalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Logica que crea un boton para abri un modal y realizar un comentario
            Actions\Action::make('contacto')
                ->icon('heroicon-o-plus')
                ->color('gray')
                ->form([
                    Select::make('tipo_contacto_id')
                        ->label('Tipo Contacto:')
                        ->preload()
                        ->options(TipoContacto::all()->pluck('tipo_contacto', 'id_tipo_contacto'))
                        ->required(),
                    TextInput::make('contacto')
                        ->label('Contacto:')
                        ->required()
                ])
                ->action(function (array $data, Personal $record) {
                    Contacto::create([
                        'personal_id' => $record->idpersonal,
                        'tipo_contacto_id' => $data['tipo_contacto_id'],
                        'contacto' => $data['contacto'],
                    ]);
                    // Refrescar el componente al insertar nuevos datos
                    $this->dispatch('refreshPersonalContacto');
                })->modal()->closeModalByClickingAway(false),

            // Logica que crea un boton para abri un modal y realizar un comentario
            Actions\Action::make('emergencia')
                ->icon('heroicon-o-plus')
                ->color('gray')
                ->form([
                    Select::make('tipo_contacto_id')
                        ->label('Tipo Contacto:')
                        ->preload()
                        ->options(TipoContacto::all()->pluck('tipo_contacto', 'id_tipo_contacto'))
                        ->required(),
                    Select::make('parentesco_id')
                        ->label('Parentesco:')
                        ->preload()
                        ->options(Parentesco::all()->pluck('parentesco', 'id_parentesco'))
                        ->required(),
                    Select::make('ciudad_id')
                        ->label('Ciudad: (Opcional)')
                        ->preload()
                        ->searchable()
                        ->options(Ciudad::all()->pluck('ciudad', 'idciudades')),
                    TextInput::make('nombre_completo')
                        ->label('Nombre Completo:')
                        ->required(),
                    TextInput::make('direccion')
                        ->label('Dirección:'),
                    TextInput::make('contacto')
                        ->label('Contacto:')
                        ->required()
                ])
                ->action(function (array $data, Personal $record) {
                    ContactoEmergencia::create([
                        'personal_id' => $record->idpersonal,
                        'tipo_contacto_id' => $data['tipo_contacto_id'],
                        'parentesco_id' => $data['parentesco_id'],
                        'ciudad_id' => $data['ciudad_id'],
                        'nombre_completo' => $data['nombre_completo'],
                        'direccion' => $data['direccion'],
                        'contacto' => $data['contacto'],
                    ]);
                    // Refrescar el componente al insertar nuevos datos
                    $this->dispatch('refreshPersonalEmergencia');
                })->modal()->closeModalByClickingAway(false),
        ];
    }

    public function  infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('nombres')->label('Nombres:')->badge()->color('warning'),
                        TextEntry::make('apellidos')->label('Apellidos:')->badge()->color('warning'),
                        TextEntry::make('codigo')->label('Codigo:')->badge()->color('warning'),
                        TextEntry::make('fecha_juramento')->label('Fecha de Juramento:')->badge()->color('warning'),
                        TextEntry::make('documento')->label('Documento:')->badge()->color('warning'),
                        TextEntry::make('categoria.categoria')->label('Categoria:')->badge()->color('warning'),
                        TextEntry::make('compania.compania')->label('Compania:')->badge()->color('warning'),
                        TextEntry::make('estado.estado')->label('Estado:')->badge()->color('warning'),
                        TextEntry::make('sexo.sexo')->label('Sexo:')->badge()->color('warning'),
                        TextEntry::make('pais.pais')->label('Pais:')->badge()->color('warning'),
                    ])->columns(2),
                Livewire::make(PersonalContacto::class)->key('personal-contacto-' . $this->record->id),
                Livewire::make(PersonalEmergencia::class)->key('personal-emergencia-' . $this->record->id),
            ]);
    }
}
