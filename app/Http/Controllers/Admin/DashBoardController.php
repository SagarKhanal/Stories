<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function registered(){
        $users = User::all();


        return view('admin.register')->with('users',$users);
    }

    public function editUser(Request $request, $id){

        if($id==1){
            return redirect('/add-roles')->with("warning","Not permitted !");
        } else {
            $users = User::findOrFail($id);
            return view('admin.role-edit')->with('users',$users);
        }
    }

    public function deleteUser(Request $request, $id){

        if($id==1){
            return redirect('/add-roles')->with("warning","Not permitted !");
        } else {
            $users = User::findOrFail($id);
            $users->delete();
            return redirect('/add-roles')->with("status","User Deleted Succesfully");
        }
    }

    public function updateRole(Request $request, $id){
        $users = User::find($id);
        $users->name = $request->input("username");
        $users->usertype = $request->input("usertype");
        $users->update();

        return redirect('/add-roles')->with("status","Roles Updated Succesfully");
    }
}
