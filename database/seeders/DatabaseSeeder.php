<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Playlist;
use App\Models\Review;
use App\Models\User;
use Database\Factories\PlaylistGameFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (env('DB_CONNECTION') === 'pgsql') {
            DB::beginTransaction();
            DB::statement('SET CONSTRAINTS ALL DEFERRED;');
        } else if (env('DB_CONNECTION') === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call([
            ArtworkSeeder::class,
            CollectionSeeder::class,
            CompanyLogoSeeder::class,
            CompanySeeder::class,
            CompanyWebsiteSeeder::class,
            CoverSeeder::class,
            FranchiseSeeder::class,
            GameSeeder::class,
            GameModeSeeder::class,
            GameVideoSeeder::class,
            GenreSeeder::class,
            InvolvedCompanySeeder::class,
            LanguageSeeder::class,
            LanguageSupportSeeder::class,
            LanguageSupportTypeSeeder::class,
            MultiplayerModeSeeder::class,
            PlatformFamilySeeder::class,
            PlatformLogoSeeder::class,
            PlatformSeeder::class,
            PlatformWebsiteSeeder::class,
            PlayerPerspectiveSeeder::class,
            ReleaseDateSeeder::class,
            ScreenshotSeeder::class,
            ThemeSeeder::class,
            WebsiteSeeder::class,
        ]);

        User::factory(50)->create()->each(function ($user) {
            $user->reviews()->saveMany(Review::factory(5)->make());
            $user->playlists()->saveMany(Playlist::factory(5)->make());

            $playlists = $user->playlists;
            foreach ($playlists as $playlist) {
                $playlist->games()->attach(Game::inRandomOrder()->take(3)->pluck('igdb_id')->toArray());
            }
        });

        if (env('DB_CONNECTION') === 'pgsql') {
            DB::commit();
            DB::statement('SET CONSTRAINTS ALL IMMEDIATE;');
        } else if (env('DB_CONNECTION') === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
