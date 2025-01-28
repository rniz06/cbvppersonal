<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentescoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parentescos = [
            'Abuelo/a',
            'Concubino/a',
            'Hermano/a',
            'Hijo/a',
            'Madrastra',
            'Madre',
            'Nieto/a',
            'Nuera',
            'Padre',
            'Padrastro',
            'Pareja',
            'Primo/a',
            'Sobrino/a',
            'Suegro/a',
            'Tio/a',
            'Yerno',
        ];
        
        // Iterar sobre el array de estados y insertar cada una en la base de datos
        foreach ($parentescos as $parentesco) {
            DB::table('personal_parentescos')->insert([
                'parentesco' => $parentesco,
            ]);
        }
    }
}
