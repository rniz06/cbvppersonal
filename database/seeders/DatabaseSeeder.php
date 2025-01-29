<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ronald Niz',
            'email' => 'ronald.niz@cbvp.org.py',
            'password' => Hash::make('Rann2006'),
        ]);

        // Seeder a ejecutarse con el principal
        $this->call([
            ParentescoSeeder::class,
            PersonalEstadoActualizar::class,
            PersonalTipoContactoSeeder::class,
        ]);
    }
}
