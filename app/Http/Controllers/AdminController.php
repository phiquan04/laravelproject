<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
   public function adminlogin() {
    return view('admin.adminlogin');
   }
   public function adminlogout()
   {
       Auth::logout();
       return redirect()->route('login');
   }public function dashboard(){
    return view('dashboard.home');
  }
   public function admin_dashboard(Request $request){
     $userEmail = $request->userEmail;
     $userPassword = $request->userPassword;

     $result = DB::table('users')->where('email', $userEmail)->where('password', $userPassword)->first();
     if($result){
      Session::put('username', $result->name);
      Session::put('userID', $result->id);
     return view('dashboard.home');
     }else
     Session::put('error','Invalid credentials');
     return Redirect::to('/dashboard');
   }
   public function logout(){
    Session::put('username', null);
      Session::put('userID', null);
      return Redirect::to('/dashboard');
   }
   public function respon(){
    return view('layouts.master');
   }
   public function profile(){
    return view('profile');
  }
  public function admin_login(){
    return view('admin_login');
  }
  public function load_dashboard(){
    return view('dashboard.home');
  }
  public function allHotels(){
    return view('hotels.allhotel');
}
public function addHotels(){
    return view('hotels.addhotel');
}
public function editHotels(){
  return view('hotels.edithotel');
}
public function calendar(){
  return view('calendar');
}
}

