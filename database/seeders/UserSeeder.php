<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $users = [
            ['name' => 'Admin User',  'email' => 'admin@example.com',  'password' => '12345678', 'role' => 'admin'],
            ['name' => 'Seller User', 'email' => 'seller@example.com', 'password' => '12345678', 'role' => 'seller'],
            ['name' => 'Buyer User',  'email' => 'buyer@example.com',  'password' => '12345678', 'role' => 'buyer'],
        ];

        foreach ($users as $u) {
            $user = User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make($u['password']),
            ]);
            $role = Role::findOrCreate($u['role']);
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
