<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@iskulapp.ph',
            'password' => Hash::make('iskulapp'),
        ]);

        UserProfile::factory()->create([
            'user_id' => $user->id,
            'first_name' => 'IA',
            'last_name' => 'Admin',
        ]);

        $user->assignRole(RoleEnum::ADMIN);
    }
}
