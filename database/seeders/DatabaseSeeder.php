<?php

namespace Database\Seeders;


use Database\Factories\UserFactory;
use Database\Seeders\AlbumsTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use App\Models\Rate;
use Database\Factories\ArtistFactory;
use Database\Factories\AlbumFactory;
use Database\Factories\SongFactory;
use Database\Factories\RateFactory;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $users = User::factory()->count(50)->create();

        Artist::factory()
            ->count(50)
            ->has(
            Album::factory()->count(3)
                ->has(Song::factory()->count(10))
            )
            ->create();

        $albums = Album::all();
        foreach ($albums as $album) {
            $randomUserIds = $users->random(rand(1, 15))->pluck('id')->all();
            $rates = Rate::factory()->count(count($randomUserIds))->make()->toArray();

            $attachData = [];
            foreach ($randomUserIds as $i => $userId) {
                $rateData = $rates[$i] ?? [];
                unset($rateData['id'], $rateData['album_id']);
                $rateData['user_id'] = $userId;

                $attachData[] = $rateData;
            }

            if (!empty($attachData)) {
                $album->rates()->createMany($attachData);
            }
        }
    }
}
