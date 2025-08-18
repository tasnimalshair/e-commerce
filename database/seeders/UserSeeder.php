<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $users = [
            ['name' => 'Admin User',  'email' => 'admin@example.com',  'password' => '12345678', 'role' => 'admin'],
            ['name' => 'Seller1 User', 'email' => 'seller1@example.com', 'password' => '12345678', 'role' => 'seller'],
            ['name' => 'Seller2 User', 'email' => 'seller2@example.com', 'password' => '12345678', 'role' => 'seller'],
            ['name' => 'Seller3 User', 'email' => 'seller3@example.com', 'password' => '12345678', 'role' => 'seller'],
            ['name' => 'Buyer1 User',  'email' => 'buyer1@example.com',  'password' => '12345678', 'role' => 'buyer'],
            ['name' => 'Buyer2 User',  'email' => 'buyer2@example.com',  'password' => '12345678', 'role' => 'buyer'],
            ['name' => 'Buyer3 User',  'email' => 'buyer3@example.com',  'password' => '12345678', 'role' => 'buyer'],
        ];

        foreach ($users as $u) {
            $user = User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make($u['password']),
            ]);
            $role = Role::findOrCreate($u['role'], 'api');
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
