<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artists;
use Illuminate\Support\Facades\DB;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (DB::table('artists')->count() === 0) { 
             Artists::create([
            'name' => 'Interpol',
            'genre' => 'Post-punk revival',
             ]);

             Artists::create([
             'name' => 'The Strokes',
             'genre' => 'Garage rock revival',
             ]);       

             Artists::create([
            'name' => 'The White Stripes',
            'genre' => 'Alternative rock',
            ]);

            Artists::create([
            'name' => 'Roy Orbison',
            'genre' => 'Rock and roll',
            ]);

        }
      

        //
    }
}
