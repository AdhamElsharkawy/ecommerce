<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CmsPage;
use Database\Seeders\AdminsTableSeeder;
use Database\Seeders\CmsPageTableSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\StoreSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminsTableSeeder::class,
            CmsPageTableSeeder::class,
            CategorySeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
