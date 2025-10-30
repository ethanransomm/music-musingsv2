<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use Illuminate\Support\Facades\DB;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (Artist::count() > 0) { 
            return; 
        }

             Artist::create([
            'artistName' => 'Interpol',
            'genre' => 'Post-punk revival',
             ]);

             Artist::create([
             'artistName' => 'The Strokes',
             'genre' => 'Garage rock revival',
             ]);       

             Artist::create([
            'artistName' => 'The White Stripes',
            'genre' => 'Alternative rock',
            ]);

            Artist::create([
            'artistName' => 'Roy Orbison',
            'genre' => 'Rock and roll',
            ]);

            Artist::create([
            'artistName' => 'Madvillain',
            'genre' => 'Hip hop',
            ]);

        }
      

        //
    }
