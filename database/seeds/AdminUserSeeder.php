<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmailtest.com',
            'name' => 'Super admin',
            'password' => bcrypt('secret'),
            'user_name' => 'admin',
            'user_role' => 'admin',
            'registered_at' => now(),
            'is_verified' => true,
        ]);
    }
}
