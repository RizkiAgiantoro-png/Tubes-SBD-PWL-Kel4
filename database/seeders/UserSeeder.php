<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ─────────────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@lumiere.test'],
            [
                'name'              => 'Admin Lumiere',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // ── Owner ─────────────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'owner@lumiere.test'],
            [
                'name'              => 'Owner Lumiere',
                'password'          => Hash::make('password'),
                'role'              => 'owner',
                'email_verified_at' => now(),
            ]
        );

        // ── Customer (untuk testing) ───────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'customer@lumiere.test'],
            [
                'name'              => 'Customer Lumiere',
                'password'          => Hash::make('password'),
                'role'              => 'customer',
                'email_verified_at' => now(),
            ]
        );
    }
}
