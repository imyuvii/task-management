<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrcreate([
            'email' => 'john@example.com',
        ], [
            'name' => 'John Doe',
            'password' => bcrypt('JohnDoe123'),
        ]);
    }
}
