<?php

namespace App\Livewire\Personal;

use App\Models\Personal;
use App\Models\Personal\Contacto as PersonalContacto;
use App\Models\Personal\ContactoEmergencia;
use Livewire\Component;

class Contacto extends Component
{
    protected $listeners = ['refreshPersonalContacto' => '$refresh'];
    
    public Personal $record;

    public function render()
    {
        $contactos = PersonalContacto::select('id_personal_contacto', 'personal_id', 'tipo_contacto_id', 'contacto')
            ->where('personal_id', $this->record->idpersonal)
            ->with('tipoContacto')
            ->get();
        return view('livewire.personal.contacto', compact('contactos'));
    }
}
