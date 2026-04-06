<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin OSIS',
            'email' => 'admin@osis-sma5.sch.id',
            'password' => Hash::make('admin12345'),
            'email_verified_at' => now(),
        ]);
        
        // Tambahan user untuk super admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@osis-sma5.sch.id',
            'password' => Hash::make('superadmin123'),
            'email_verified_at' => now(),
        ]);
    }
}