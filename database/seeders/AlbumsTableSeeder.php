<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Albums;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a = new Albums;
        $a->title = 'Turn on the Bright Lights';
        $a->artist = 'Interpol';
        $a->release_date = '2002-08-20';
        $a->genre = 'Post-punk revival';
        $a->save();

        $a = new Albums;
        $a->title = 'Is This It';
        $a->artist = 'The Strokes';
        $a->release_date = '2001-07-30';
        $a->genre = 'Garage rock revival';
        $a->save();

        $a = new Albums;
        $a->title = 'Elephant';
        $a->artist = 'The White Stripes';
        $a->release_date = '2003-04-01';
        $a->genre = 'Alternative rock';
        $a->save();

        $a = new Albums;
        $a->title = 'Madvillainy';
        $a->artist = 'Madvillain';
        $a->release_date = '2004-03-23';
        $a->genre = 'Hip hop';
        $a->save();

        $a = new Albums;
        $a->title = 'In Dreams';
        $a->artist = 'Roy Orbison';
        $a->release_date = '1963-07-01';
        $a->genre = 'Rock and roll';
        $a->save();
    }
}
