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
            'id'            => '01001',
            'name'          => 'Home',
            'url'           => 'home',
            'icon'          => 'typcn typcn-home-outline',
            'description'   => 'Dashboard',
            'display_st'    => '1'

        ]);
        Navigation::create([
            'id'            => '01002',
            'name'          => 'Settings',
            'url'           => 'settings',
            'icon'          => 'typcn typcn-cog-outline',
            'description'   => 'Pengaturan Aplikasi',
            'display_st'    => '1'

        ]);
        Navigation::create([
            'id'            => '01003',
            'name'          => 'Navigations',
            'url'           => 'settings/navigations',
            'icon'          => '',
            'parent_id'     => '01002',
            'description'   => 'Pengaturan Navigasi Menu Aplikasi',
            'display_st'    => '1'

        ]);
        Navigation::create([
            'id'            => '01004',
            'name'          => 'Management Users',
            'url'           => 'settings/users',
            'icon'          => '',
            'parent_id'     => '01002',
            'description'   => 'Pengaturan User',
            'display_st'    => '1'
        ]);
        Navigation::create([
            'id'            => '01005',
            'name'          => 'Permissions',
            'url'           => 'permissions',
            'icon'          => 'typcn typcn-group-outline',
            'description'   => 'Pengaturan Izin Menu',
            'display_st'    => '1'
        ]);
    }
}
