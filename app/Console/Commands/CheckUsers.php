<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUsers extends Command
{
    protected $signature = 'users:check';
    protected $description = 'Check all users and their roles';

    public function handle()
    {
        $users = User::with('roles')->get();

        if ($users->isEmpty()) {
            $this->info('No users found in database.');
            return;
        }

        $this->info('Users in database:');
        $this->line('');

        foreach ($users as $user) {
            $roles = $user->roles->pluck('name')->implode(', ');
            $roles = $roles ?: 'No roles assigned';

            $this->line("ID: {$user->id} | Name: {$user->name} | Email: {$user->email} | Roles: {$roles}");
        }
    }
}
