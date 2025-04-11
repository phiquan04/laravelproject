<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Product;
use App\Models\User;
use App\Models\Room;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AccountController extends Controller
{
    public function allUsers(){
        $users = DB::table('users')->get();
        return view('formaccount.allusers', compact('users'));
    }
    public function allinvoices(){
        return view('formaccount.invoices');
    }
    public function addUsers(){
        return view('formaccount.addusers');
    }
    public function saveUsers(Request $request){
        $data = [
            'name' => $request->username,
            'email' => $request->useremail,
            'password' => $request->userpassword,
            'role' => $request->userrole
        ];
        DB::table('users')->insert($data);
        Session::flash('success', 'add successed');
        return Redirect::to('/all-users');
    }
    public function updateUsers($id){
        $editUsers = DB::table('users')->where('id', $id)->get();

        return view('formaccount.editusers', compact('editUsers'));
    }
    public function updatedUsers(Request $request){
        $data = [
            'name' => $request->username,
            'email' => $request->useremail,
            'password' => $request->userpassword,
            'role' => $request->userrole
        ];
        DB::table('users')->where('email', $data['email'])->update($data);

        Session::flash('success', 'Update successed');
        return redirect('/all-users');
    }
    public function deleteUser($id)
{
    $user = User::findOrFail($id); 

    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}

}
