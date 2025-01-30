<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function ficha($record)
    {
        // Cargar todas las relaciones en una sola consulta
        $personal = Personal::with([
            'categoria',
            'estado',
            'sexo',
            'pais',
            'estadoActualizar',
            'grupoSanguineo',
            'contactos.tipoContacto',
            'contactosEmergencias.tipoContacto',
            'contactosEmergencias.parentesco',
            'contactosEmergencias.ciudad',
            'compania'
        ])
            ->findOrFail($record);

        $pdf = Pdf::loadView('personal.ficha', [
            'personal' => $personal,
            'usuario' => auth()->user(),
            'contactos' => $personal->contactos,
            'contactosEmergencias' => $personal->contactosEmergencias
        ]);

        return $pdf->download('CBVP Ficha  de personal ' . $personal->codigo . '.pdf');
    }
}
