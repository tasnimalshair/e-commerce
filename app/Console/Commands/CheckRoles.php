<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CheckRoles extends Command
{
    protected $signature = 'roles:check';
    protected $description = 'Check all roles in database';

    public function handle()
    {
        $roles = Role::all(['id', 'name', 'guard_name']);

        if ($roles->isEmpty()) {
            $this->info('No roles found in database.');
            return;
        }

        $this->info('Roles in database:');
        $this->line('');

        foreach ($roles as $role) {
            $this->line("ID: {$role->id} | Name: {$role->name} | Guard: {$role->guard_name}");
        }
    }
}
