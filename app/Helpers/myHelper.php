<?php

use App\Models\Navigation;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        $menus = Navigation::with('subMenus')->whereNull('parent_id')->orderBy('nav_no', 'asc')->get();
        return $menus;
    }
}
