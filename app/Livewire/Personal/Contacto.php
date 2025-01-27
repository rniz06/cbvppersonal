<?php

namespace App\Livewire\Personal;

use App\Models\Personal;
use App\Models\Personal\Contacto as PersonalContacto;
use Livewire\Component;

class Contacto extends Component
{
    public Personal $personal;

    public function render()
    {
        $contactos = PersonalContacto::select('id_personal_contacto', 'personal_id', 'tipo_contacto_id', 'contacto')
        ->with('tipoContacto')
        ->get();
        return view('livewire.personal.contacto', compact('contactos'));
    }
}
