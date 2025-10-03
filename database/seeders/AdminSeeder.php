<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $password = env('ADMIN_PASSWORD', 'password123');

        $exists = User::where('email', $email)->first();
        if (!$exists) {
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]);
        } else if ($exists->role !== 'admin') {
            $exists->update(['role' => 'admin']);
        }
    }
}
