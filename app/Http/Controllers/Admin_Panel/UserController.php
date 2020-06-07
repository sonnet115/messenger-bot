<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
     public function viewUserForm(){
         return view("admin_panel.user.addUserForm");
     }

     public function storeUser(Request $request){
         $validator = Validator::make($request->all(), [
             'name' => 'required|unique:users',
             'username' => 'required|unique:users',
             'roles' => 'required',
             'password' => 'required|string|max:50',

         ]);

//         dd($validator);

         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $user= new User();
         $user->name=$request->name;
         $user->username=$request->username;
         $user->password=$request->password;
         $user->role_id=$request->roles;
        $user->save();
        return redirect(route('user.add.view'));

     }

}
