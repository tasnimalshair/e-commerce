<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignAdminRole extends Command
{
    protected $signature = 'user:make-admin {email}';
    protected $description = 'Assign admin role to an existing user';

    public function handle()
    {
        $email = $this->argument('email');

        // Find user
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return;
        }

        // Check if admin role exists
        $adminRole = Role::where('name', 'admin')->where('guard_name', 'api')->first();
        if (!$adminRole) {
            $this->error('Admin role not found! Please run: php artisan db:seed --class=RoleSeeder');
            return;
        }

        // Check if user already has admin role
        if ($user->hasRole('admin')) {
            $this->info("User {$user->name} already has admin role!");
            return;
        }

        // Assign admin role
        $user->assignRole($adminRole);

        $this->info("Admin role assigned successfully to {$user->name} ({$email})!");
    }
}
