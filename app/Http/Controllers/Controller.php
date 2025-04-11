<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Hash;
use Auth;
use Mail;
use Illuminate\Support\Str;


class Controller extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function forgot(){
        return view('auth.forgotpassword');
    }
    public function reset($token){
        $user=User::where('remember_token','=',$token)->first();
        if(!empty($user)){
            $data['user']=$user;
            return view('auth.reset',$data);

        }else{
           abort(404);
        }
    }

    public function postForgotPassword(Request $request){

        $user=User::where('email','=',$request->email)->first();
        if(!empty($user)){
            $user->remember_token=str::random(40);
         $user->save();
        Mail::to($user->email)->send(new ForgotPasswordMail($user));
        return redirect()->back()->with('success', 'Please check your email and reset passord!');
        }else{
            return redirect()->back()->with('error', 'Email not found!');
        }
    }
    public function postReset($token,Request $request){
        $user=User::where('remember_token','=',$token)->first();

        if(!empty($user)){
           if($request->password==$request->cpassword){
            $user->password=Hash::make($request->password);
            if(empty($user->email_verified_at)){
            $user->email_verified_at=date('Y-m-d H:i:s');
            }
            $user->remember_token=str::random(40);
            $user->save();
            return view('auth.login')->with('success', 'Password Reset Successfully');
           }else{
            return redirect()->back()->with('error', 'Password and Confirm Password does not match!');
           }
        }else{
           abort(404);
        }
    }
    public function postUpdateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'gender' => 'required|string:Nam,Nữ',
            'birthday' => 'required|date',
        ]);
        $userId = $request->input('id');
        $user = User::find($userId);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');
        $user->birthday = $request->input('birthday');
        $user->save();

        session()->flash('alert', 'Account successfully updated!');
        return view('user.account');
    }
    public function postRegister(Request $req)
    {
        $req->merge(['password' => Hash::make($req->password)]);

        try {
            User::create($req->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('login');
    }
    public function postLogin(Request $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password, 'role' => 1])) {
            return redirect()->route('admin.admin1');
        }
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect()->route('index');
        } else
            return redirect()->back()->with('error', 'Wrong account or password!');
    }
    public function redirects()
    {
        $role = Auth::user()->role;
        if ($role == '1') {
            return view('admin.admin1');
        } else {
            return view('user.index');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function about()
    {
        return view('user.about-us');
    }

    public function banhmi()
    {
        return view('user.banhmi');
    }

}
