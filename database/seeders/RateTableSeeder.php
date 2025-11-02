<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rate;
use App\Models\User;
use App\Models\Album;

class RateTableSeeder extends Seeder
{

    public function run(): void
    {

        // Access both tables
        $users = User::all();
        $albums = Album::all();

        // Ensure tables being accessed are populated
        if ($users->isEmpty() || $albums->isEmpty()) {
            return;
        }

        // Iterate through albums to give them a randomised user rating
        foreach ($albums as $album) {
            // Select a random number of users at a time
            $randomUserIds = $users->random(rand(1, 15))->pluck('id')->all();

            // Instantiate Rate models and get the models as an array
            $rates = Rate::factory()->count(count($randomUserIds))->make()->toArray();
        }

        $attachData = [];
        foreach ($randomUserIds as $i => $userId) {
            $rateData = $rates[$i] ?? [];

            // Remove unnecessary keys from the generated models
            unset($rateData['id'], $rateData['album_id']);

            // Assign a user ID for the many-to-many relationship
            $rateData['user_id'] = $userId;

            $attachData[] = $rateData;
        }

        // Save the rate records 
        if (!empty($attachData)) {
            // As rates has a HasMany relationship with the album class, create the ratings
            $album->rates()->createMany($attachData);
        }

    }
}

