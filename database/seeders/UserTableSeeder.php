<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {

        // Generate 50 random users in line with other seeders to prevent 
        // errors from lack of assignment
        User::factory()->count(50)->create();

    }
}
