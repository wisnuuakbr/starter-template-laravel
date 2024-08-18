<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert users
        $user_id = '01001';

        DB::table('users')->insert([
            'user_id'           => $user_id,
            'user_alias'        => 'Wisnu Akbara',
            'user_name'         => 'Wisnu',
            'user_mail'         => 'wisnu@varx.co.id',
            'user_pass'         => Hash::make('wisnu123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
        ]);

        // Insert to user roles table
        DB::table('role_users')->insert([
            'role_id'    => '1',
            'user_id'    => $user_id,
            'created_at' => now(),
        ]);
    }
}