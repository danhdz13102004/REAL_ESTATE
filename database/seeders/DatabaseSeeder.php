<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id' => '1',
            'name' => 'Test User',
            'email' => 'danh@gmail.com',
            'password' => 123
        ]);

        Listing::factory(20)->create([
            'user_id' => '1'
        ]);
    }
}
