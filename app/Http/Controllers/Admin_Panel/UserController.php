<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function viewUserForm(){
         return view("admin_panel.user.addUserForm");
     }
}
