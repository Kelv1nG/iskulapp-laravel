<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::rolesForApi() as $role) {
            Role::create(['guard_name' => 'api', 'name' => $role->value]);
        }
        Role::create(['guard_name' => 'web', 'name' => RoleEnum::ADMIN]);

    }
}
