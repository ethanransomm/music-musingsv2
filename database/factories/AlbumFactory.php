<?php

namespace Database\Factories;
use App\Models\Artist;
use App\Models\Album;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{


    
    protected $model = Album::class;

    public function definition(): array
    {

        $artistIds = Artist::pluck('id')->toArray();

        return [
            'title'=> fake()->sentence,
            'artist_id'=> fake()->randomElement($artistIds),
            'release_date'=> fake()->date(),
            'genre'=> fake()->words(2, true),
        ];
    }
}




