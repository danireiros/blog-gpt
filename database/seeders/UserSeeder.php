<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ReiAdmin',
            'role' => 1,
            'email' => 'danireiros@gmail.com',
            'password' => Hash::make('jamala56'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'current_team_id' => 1,
            'profile_photo_path' => null,
        ]);
    }
}
