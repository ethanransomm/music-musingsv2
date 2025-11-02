<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Album;
use App\Models\User;
use App\Models\Rate;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Rate::class;
    
    public function definition(): array
    {

        $userIds = User::pluck('id')->toArray();
        $albumIds = Album::pluck('id')->toArray();

        return [
                'user_id'=> fake()->randomElement($userIds),
                'album_id'=> fake()->randomElement($albumIds),
                "score"=> fake()->numberBetween(1,10),
                "comment"=> fake()->sentence(50)
            //
        ];
    }
}
