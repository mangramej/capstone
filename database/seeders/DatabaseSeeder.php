<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use AddressSeeder;
use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddressSeeder::class,
            AdminSeeder::class,
//            ProviderSeeder::class,
        ]);
    }
}
