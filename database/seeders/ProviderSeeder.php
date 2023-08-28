<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->count(25)
            ->type(UserEnum::Provider)
            ->registered()
            ->create();
    }
}
