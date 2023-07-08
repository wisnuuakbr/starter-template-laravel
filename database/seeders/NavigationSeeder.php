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
        Navigation::create([
            'name'          => 'Home',
            'url'           => 'home',
            'icon'          => 'typcn typcn-home-outline',
            'description'   => 'Dashboard',
            'display_st'    => '1'

        ]);
        Navigation::create([
            'name'          => 'Settings',
            'url'           => 'settings',
            'icon'          => 'typcn typcn-cog-outline',
            'description'   => 'Pengaturan Aplikasi',
            'display_st'    => '1'

        ]);
        Navigation::create([
            'name'          => 'Navigations',
            'url'           => 'settings/navigations',
            'icon'          => '',
            'description'   => 'Pengaturan Navigasi Menu Aplikasi',
            'display_st'    => '1'

        ]);
        Navigation::create([
            'name'          => 'Management Users',
            'url'           => 'settings/users',
            'icon'          => '',
            'description'   => 'Pengaturan User',
            'display_st'    => '1'
        ]);
        Navigation::create([
            'name'          => 'Permissions',
            'url'           => 'permissions',
            'icon'          => 'typcn typcn-group-outline',
            'description'   => 'Pengaturan Izin Menu',
            'display_st'    => '1'
        ]);
    }
}
