<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Album;
use Database\Factories\AlbumFactory;
use App\Models\Song;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Song::class; 


    public function definition(): array
    {

        return [
                "title"=> fake()->name(),
                "duration"=> fake()->numberBetween(60, 350),
                "album_id"=> fake()->numberBetween(1,50),
                ];
            //
    }
}
