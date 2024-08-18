<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Developer',
                'role_desc' => 'Has full access to all functionalities and menu',
                'created_at' => now()
            ],
            [
                'role_name' => 'Admin',
                'role_desc' => 'Has full access to all admin menu',
                'created_at' => now()
            ],
            [
                'role_name' => 'Cashier',
                'role_desc' => 'Can manage transaction only',
                'created_at' => now()
            ],
        ]);
    }
}