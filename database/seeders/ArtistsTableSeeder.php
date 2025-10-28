<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a = new \App\Models\Artists;
        $a->name = 'Interpol';
        $a->genre = 'Post-punk revival';
        $a->save();

        $a = new \App\Models\Artists;
        $a->name = 'The Strokes';
        $a->genre = 'Garage rock revival';
        $a->save();

        $a = new \App\Models\Artists;
        $a->name = 'The White Stripes';
        $a->genre = 'Alternative rock';
        $a->save();

        $a = new \App\Models\Artists;
        $a->name = 'Madvillain';
        $a->genre = 'Hip hop';
        $a->save();

        $a = new \App\Models\Artists;
        $a->name = 'Roy Orbison';
        $a->genre = 'Rock and roll';
        $a->save();

        //
    }
}
