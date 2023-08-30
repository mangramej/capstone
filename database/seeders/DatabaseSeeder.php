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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AddressSeeder::class,
            //            ProviderSeeder::class,
        ]);
        //
        //        User::factory()
        //            ->registered()
        //            ->type(UserEnum::Champion)
        //            ->create([
        //                'email' => 'champion@test.com',
        //            ]);
    }
}
