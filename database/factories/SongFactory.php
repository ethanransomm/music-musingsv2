<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Song;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{

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



