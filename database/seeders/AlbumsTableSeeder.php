<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Albums;
use Illuminate\Support\Facades\DB;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         if (DB::table('albums')->count() === 0) { 
            
             Albums::create([
            'title' => 'Turn on the Bright Lights',
            'artist' => 'Interpol',
            'release_date' => '2002-08-20',
            'genre' => 'Post-punk revival',
             ]);

             Albums::create([
             'title' => 'Is This It',
             'artist' => 'The Strokes',
             'release_date' => '2001-07-30',
             'genre' => 'Garage rock revival',
             ]);       

             Albums::create([
            'title' => 'Elephant',
            'artist' => 'The White Stripes',
            'release_date' => '2003-04-01',
            'genre' => 'Alternative rock',
            ]);

            Albums::create([
            'title' => 'Madvillainy',
            'artist' => 'Madvillain',
            'release_date' => '2004-03-23',
            'genre' => 'Hip hop',
            ]);

            Albums::create([
            'title' => 'In Dreams',
            'artist' => 'Roy Orbison',
            'release_date' => '1963-07-01',
            'genre' => 'Rock and roll',
            ]);


        }
      

    }
}
