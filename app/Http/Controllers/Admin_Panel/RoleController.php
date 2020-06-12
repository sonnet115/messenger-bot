<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public  function viewAddRoleForm(){
        return view("admin_panel.role.add_role_form")->with("title", "CBB | Add Role");
    }

    public function viewUpdateRole(){
        return view("admin_panel.user.manage_user")->with("title", "CBB | Role List");
    }
}
