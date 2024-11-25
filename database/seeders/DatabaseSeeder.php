<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'uuid' => Str::uuid(),
            'name' => 'madmans',
            'role' => 'admin',
            'firstname' => 'madmans',
            'lastname' => 'madmans',
            'email' => 'madmans@example.com',
            'password' => Hash::make('madmans@example.com')
        ]);
    }
}
