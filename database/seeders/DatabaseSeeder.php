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
       Event::factory(10)->create(['image'=>'https://tinyurl.com/y5wshz4s']);
       Event::factory(5)->create(['isHighlighted'=> 1, 'image'=>'https://tinyurl.com/y3csscxh', 'date' => '2026-08-22']);
       User::factory(1)->create(['name'=>'admin',
            'email'=>'admin@admin',
            'password' => Hash::make("12345678"),
            'isAdmin'=> 1]);
    }
}
