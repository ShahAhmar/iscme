<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create
        {email : Email address for the administrator}
        {--name= : Display name}
        {--role=super_admin : super_admin, admin, or editor}';

    protected $description = 'Create or update an administrator account';

    public function handle(): int
    {
        $email = (string) $this->argument('email');
        $role = (string) $this->option('role');

        if (! in_array($role, User::ADMIN_ROLES, true)) {
            $this->error('Role must be one of: '.implode(', ', User::ADMIN_ROLES));

            return self::FAILURE;
        }

        $user = User::where('email', $email)->first();
        if ($user && ! $this->confirm("An account for {$email} already exists. Update it?")) {
            return self::SUCCESS;
        }

        $name = $this->option('name') ?: $this->ask('Name', $user?->name ?? 'Administrator');
        $password = $this->secret('Password (at least 12 characters)');

        if (! is_string($password) || strlen($password) < 12) {
            $this->error('A password of at least 12 characters is required.');

            return self::FAILURE;
        }

        if ($password !== $this->secret('Confirm password')) {
            $this->error('Passwords do not match.');

            return self::FAILURE;
        }

        $attributes = [
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ];

        $user ? $user->update($attributes) : User::create($attributes);

        $this->info("{$role} account is ready for {$email}.");

        return self::SUCCESS;
    }
}
