<?php

namespace Database\Seeders;

use App\Users\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->count(50)
            ->create();
    }
}
