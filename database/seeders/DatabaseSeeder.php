<?php

namespace Database\Seeders;

use App\Models\Event;
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
       User::factory(10)->create();
       User::factory(1)->create(['name'=>'admin',
            'email'=>'admin@admin',
            'password' => Hash::make("12345678"),
            'isAdmin'=> 1]);
    }
}

