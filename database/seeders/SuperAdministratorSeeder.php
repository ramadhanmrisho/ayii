<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdministratorSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('AYII_SUPER_ADMIN_EMAIL', 'admin@ayii.test');
        $password = app()->environment('production')
            ? env('AYII_SUPER_ADMIN_PASSWORD')
            : 'wcf';

        if (! $password && app()->environment('production')) {
            return;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('AYII_SUPER_ADMIN_NAME', 'Ayii Super Administrator'),
                'position' => 'Super Administrator',
                'password' => $password,
                'active' => true,
            ]
        );

        $user->assignRole('Super Administrator');

        if (! app()->environment('production')) {
            $this->command?->warn("Development super admin password for {$email}: {$password}");
        }
    }
}
