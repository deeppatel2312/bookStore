<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789')
        ]);

        Setting::create([
            'title' => 'Joining Bonus',
            'key' => 'bonus',
            'value' => 100
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
