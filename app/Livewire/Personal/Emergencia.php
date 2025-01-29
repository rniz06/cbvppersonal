<?php

namespace App\Livewire\Personal;

use App\Models\Personal;
use App\Models\Personal\ContactoEmergencia;
use Livewire\Component;

class Emergencia extends Component
{
    protected $listeners = ['refreshPersonalEmergencia' => '$refresh'];

    public Personal $record;

    public function render()
    {
        $emergencias = ContactoEmergencia::select(
            'id_contacto_emergencia',
            'personal_id',
            'tipo_contacto_id',
            'parentesco_id',
            'ciudad_id',
            'nombre_completo',
            'direccion',
            'contacto'
        )
            ->where('personal_id', $this->record->idpersonal)
            ->with('tipoContacto', 'parentesco')
            ->get();
        return view('livewire.personal.emergencia', compact('emergencias'));
    }
}
