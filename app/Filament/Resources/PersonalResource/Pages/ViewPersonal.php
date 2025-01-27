<?php

namespace App\Filament\Resources\PersonalResource\Pages;

use App\Filament\Resources\PersonalResource;
use App\Models\Personal;
use App\Models\Personal\Contacto;
use App\Models\Personal\TipoContacto;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Grid;
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
                    $contacto = new Contacto();

                    $contacto->personal_id = $record->idpersonal;
                    $contacto->tipo_contacto_id = $data['tipo_contacto_id'];
                    $contacto->contacto = $data['contacto'];
                    $contacto->save();
                }),
        ];
    }

    public function  infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('nombres'),
                        TextEntry::make('apellidos'),
                        TextEntry::make('codigo'),
                        TextEntry::make('fecha_juramento'),
                        TextEntry::make('documento'),
                        TextEntry::make('categoria.categoria'),
                        TextEntry::make('compania.compania'),
                        TextEntry::make('estado.estado'),
                        TextEntry::make('sexo.sexo'),
                        TextEntry::make('pais.pais'),
                    ])->columns(2),
                    Section::make()
                    ->schema([
                        TextEntry::make('contactos.contacto'),
                        // RepeatableEntry::make('contactos')
                        // ->schema([
                        //     TextEntry::make('contacto'),
                        // ])
                    ])->columns(2)
                // Grid::make(3)
                //     ->schema([
                //         //Livewire::make(Comentario::class)->columnSpan(2),
                //         Section::make('Detalles del Expediente')
                //             ->schema([
                //                 TextEntry::make('expediente_asunto')->label('Asunto:'),
                //                 TextEntry::make('mesa_entrada_completa')->label('N° Mesa Entrada:')->badge(),
                //                 TextEntry::make('estado.expediente_estado')->label('Estado:')->badge(),
                //                 TextEntry::make('ciudadano.nombre_completo')->label('Responsable:'),
                //                 TextEntry::make('departamento.departamento_nombre')->label('Dirección Actual:')->badge(),
                //                 TextEntry::make('departamentosConCopia.departamento_nombre')->label('Con Copia a:')->badge(),
                //                 RepeatableEntry::make('archivos')
                //                     ->schema([
                //                         TextEntry::make('archivo_nombre_original')->label('')->badge()->openUrlInNewTab()
                //                             ->url(fn(ExpedienteArchivo $record) => route('expediente.descargar.archivo', $record->id_expediente_archivo))
                //                     ])->contained(false)
                //             ])->columnSpan(1)
                //     ])
            ]);
    }
}
