<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalEstadoActualizar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            'Falta Actualizar',
            'Actualizado',
        ];
        
        // Iterar sobre el array de estados y insertar cada una en la base de datos
        foreach ($estados as $estado) {
            DB::table('personal_estado_actualizar')->insert([
                'estado' => $estado,
            ]);
        }
    }
}
