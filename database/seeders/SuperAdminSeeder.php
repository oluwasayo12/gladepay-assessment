<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'email' => 'superadmin@admin.com',
            'password' => 'password',
            'status' => true
        ]);
        $admin->assignRole('super-admin');
    }
}
