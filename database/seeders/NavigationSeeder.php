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
            'name'  => 'Settings',
            'url'  => 'settings',
            'icon'  => 'mdi mdi-settings',

        ]);
        Navigation::create([
            'name'  => 'Navigations',
            'url'  => 'settings/navigations',
            'icon'  => '',

        ]);
        Navigation::create([
            'name'  => 'Permissions',
            'url'  => 'settings/permissions',
            'icon'  => '',
        ]);
    }
}
