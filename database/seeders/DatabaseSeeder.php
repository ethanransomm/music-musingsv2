<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {

        // Call each Seeder in the correct order
        $this->call(UserTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(RateTableSeeder::class);
       
    }
}




