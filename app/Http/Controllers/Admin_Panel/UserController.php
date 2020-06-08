<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\User;
use App\UserRoleMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function viewAddUserForm()
    {
        return view("admin_panel.user.add_user_form")->with("title", "CBB | Add User");
    }

    public function storeUser(Request $request)
    {
         $validator = Validator::make($request->all(), [
             'user_name' => 'required|unique:users,name',
             'user_username' => 'required|unique:users,username',
             'user_roles' => 'required',
             'user_password' => 'required|string|max:50',

         ]);

         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
        $user = new User();

        $user->name = $request->user_name;
        $user->username = $request->user_username;
        $user->password = $request->user_password;
        $user->save();

        $user_id = $user->id;
        $user_roles = $request->user_roles;

        foreach ($user_roles as $roles){
            $userRoleMapping= new UserRoleMapping();
            $userRoleMapping->user_id=$user_id;
            $userRoleMapping->role_id=$roles;
            $userRoleMapping->save();
        }
        return redirect(route('user.add.view'));
    }

    public function viewUpdateUser(){
        return view("admin_panel.user.manage_user")->with("title", "CBB | Add User");
    }

    public function getUser()
    {
        return datatables(User::selectRaw(" * ")->whereRaw(1)->orderBy('id', 'asc'))->toJson();
    }
}
