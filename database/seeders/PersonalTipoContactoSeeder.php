<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalTipoContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo_contactos = [
            'Celular Particular',
            'Celular Corporativo',
            'Correo Electronico',
        ];
        
        // Iterar sobre el array de tipo_contactos y insertar cada una en la base de datos
        foreach ($tipo_contactos as $tipo_contacto) {
            DB::table('personal_tipo_contactos')->insert([
                'tipo_contacto' => $tipo_contacto,
            ]);
        }
    }
}
