<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

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

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
