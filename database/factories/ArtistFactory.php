<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    
    public function definition(): array
    {

        return [
            "artist_name"=> fake()->name(),
            "genre"=> fake()->words(2, true)
        ];
    }
}


