<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $roles = ['admin', 'seller', 'buyer'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'api']);
        }

        // Assign admin role to tasnim
        // $adminRole = Role::where('name', 'admin')->where('guard_name', 'api')->first();
        // $tasnim = User::where('email', 'tasnim@gmail.com')->first();

        // if ($adminRole && $tasnim) {
        //     $tasnim->assignRole($adminRole);
        // }
    }
}
