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


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $users = User::factory()->count(50)->create();

        $artists = Artist::factory()
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
            $attachData[$userId] = $rates[$i];
            }

            if (!empty($attachData)) {
            $album->rates()->attach($attachData);
            }
        }


        $this->call(ArtistsTableSeeder::class);
        $this->call(AlbumsTableSeeder::class);
        $this->call(SongsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RateTableSeeder::class);
    }
}
