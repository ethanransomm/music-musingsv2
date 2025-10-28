<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Songs;
use Illuminate\Support\Facades\DB;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

         if (DB::table('songs')->count() === 0) { 
                Songs::create([
                'title' => 'Obstacle 1',
                'artist' => 'Interpol',
                'album' => 'Turn on the Bright Lights',
                'duration' => '249',
            ]);

                Songs::create([
                'title' => 'Last Nite',
                'artist' => 'The Strokes',
                'album' => 'Is This It',
                'duration' => '202'

             ]);

                Songs::create([
                'title' => 'Seven Nation Army',
                'artist' => 'The White Stripes',
                'album' => 'Elephant',
                'duration' => '232',
            
            ]);

                Songs::create([
                    'title' => 'In Dreams',
                    'artist' => 'Roy Orbison',
                    'album' => 'In Dreams',
                    'duration' => '178',
                ]);


        }
      

    }
}
