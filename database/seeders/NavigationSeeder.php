<?php

namespace Database\Seeders;

use App\Models\Navigation;

use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Defaut Home
        Navigation::create([
            'nav_id'     => '01001',
            'nav_title'  => 'Home',
            'nav_url'    => 'home',
            'nav_icon'   => 'dripicons-home',
            'nav_desc'   => 'Dashboard',
            'nav_no'     => 1,
            'display_st' => 1,
            'created_at' => now()
        ]);
        // Default Settings
        Navigation::create([
            'nav_id'     => '01002',
            'nav_title'  => 'Apps Settings',
            'nav_url'    => '#',
            'nav_icon'   => 'dripicons-gear',
            'nav_desc'   => 'Pengaturan Aplikasi',
            'nav_no'     => 2,
            'display_st' => 1,
            'created_at' => now()
        ]);
        Navigation::create([
            'nav_id'     => '0100201',
            'nav_title'  => 'Navigations',
            'nav_url'    => 'settings/navigations',
            'nav_icon'   => '',
            'parent_id'  => '01002',
            'nav_desc'   => 'Pengaturan Navigasi Menu Aplikasi',
            'nav_no'     => 1,
            'display_st' => 1,
            'created_at' => now()
        ]);
        Navigation::create([
            'nav_id'     => '0100202',
            'nav_title'  => 'Permissions',
            'nav_url'    => 'permissions',
            'nav_icon'   => '',
            'parent_id'  => '01002',
            'nav_desc'   => 'Pengaturan Izin Menu',
            'nav_no'     => 2,
            'display_st' => 1,
            'created_at' => now()
        ]);
        // Default Management Users
        Navigation::create([
            'nav_id'     => '01003',
            'nav_title'  => 'Management Users',
            'nav_url'    => '#',
            'nav_icon'   => 'dripicons-user-group',
            'nav_desc'   => 'Pengaturan User',
            'nav_no'     => 3,
            'display_st' => 1,
            'created_at' => now()
        ]);
        Navigation::create([
            'nav_id'     => '0100301',
            'nav_title'  => 'User Admin',
            'nav_url'    => 'settings/users',
            'nav_icon'   => '',
            'parent_id'  => '01003',
            'nav_desc'   => 'Pengaturan User Admin',
            'nav_no'     => 1,
            'display_st' => 1,
            'created_at' => now()
        ]);
    }
}