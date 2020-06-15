<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Role;
use App\RoleMenuMappings;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $role = Role::where('id', 1)->with('menus')->get();
        $menus = Menu::where('id', 2)->with('subMenus')->first();
        dd($role);
        return view('admin_panel.dashboard')->with('title', "CBB | Dashboard")->with('menus', $role->menus);
    }
}
