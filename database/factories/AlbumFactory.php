<?php

namespace Database\Factories;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use App\Models\Album;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{


    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Album::class;

    public function definition(): array
    {

        $artistIds = Artist::pluck('id')->toArray();

        return [
            'title'=> $this->faker->sentence,
            'artist_id'=> $this->faker->randomElement($artistIds),
            'release_date'=> $this->faker->date(),
            'genre'=> $this->faker->words(2, true)

            //
        ];
    }
}
