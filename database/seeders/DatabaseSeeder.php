<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@skalsa.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Guru Matematika',
            'email' => 'guru@skalsa.sch.id',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        User::factory()->create([
            'name' => 'Siswa Contoh',
            'email' => 'siswa@skalsa.sch.id',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
    }
}
