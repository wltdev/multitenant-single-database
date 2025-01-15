<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userDefault = User::factory()->create([
            'name' => 'Central Admin',
            'email' => 'admin@example.com',
            'password' => '123456',
        ]);

        $userDefault->assignRole('central-admin');
    }
}
