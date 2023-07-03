<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Nombre del usuario',
            'email' => 'mirandadjmdjm@gmail.com',
            'password' => bcrypt('KORNisues'),
        ]);

        // También puedes asignar otros valores después de la creación si es necesario
        $user->email_verified_at = now();
        $user->save();
    }
}
