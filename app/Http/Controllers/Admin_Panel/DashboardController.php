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
        return view('admin_panel.dashboard')->with('title', "CBB | Dashboard");
    }
}
