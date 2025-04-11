<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Reservate;
use App\Models\Book;
use App\Models\BookingDetails;
use App\Models\Room;
use Session;
use Hash;
session_start();
class CheckoutController extends Controller
{
    public function confirm_booking(Request $request)
    {
        $data = $request->all();
        $reservate = new Reservate();
        $reservate->reservate_name = $data['reservate_name'];
        $reservate->reservate_email = $data['reservate_email'];
        $reservate->reservate_phone = $data['reservate_phone'];
        $reservate->reservate_address = $data['reservate_address'];
        $reservate->reservate_method = $data['reservate_method'];
        $reservate->userID = $data['userid'];
        $reservate->save();
        $reservate_id = $reservate->reservate_id;

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);

        $book = new Book();
        $book->book_id = Session::get('book_id');
        $book->reservate_id = $reservate_id;
        $book->book_status = 1;
        $book->book_code = $checkout_code;
        $book->save();

        if (Session::get('cart')) {
            foreach (Session::get('cart') as $key => $cart) {
                $bookdetails = new BookingDetails;
                $bookdetails->book_code = $checkout_code;
                $bookdetails->room_id = $cart['room_id'];
                $bookdetails->room_type = $cart['room_type'];
                $bookdetails->room_price = $cart['room_price'];
                $bookdetails->quantity = $cart['quantity'];
                $bookdetails->save();
            }
        }
    }
    public function login_customer(Request $request){
        $email_account = $request->email;
        $password_account = $request->password;
        $user = User::where('email', $email_account)->first();
        if ($user && Hash::check($password_account, $user->password)) {
            Session::put('id', $user->id);
            Session::put('name', $user->name);
            Session::put('email', $user->email);
            return redirect('/checkout');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }
    public function login_checkout(){
        $all_products = Product::where('status', 0)
        ->OrderBy('HotelID','desc')
        ->get();
        return view('auth.login',['all_products'=>$all_products]);
    }
    public function logout_checkout(){
        Session::flush();
        return redirect('/login-checkout');
    }
    public function viewregister(){
        return view('auth.register');
    }
    public function add_customer(Request $req){

     $data=array();
     $data['name']=$req->name;
     $data['email']=$req->email;
     $data['password'] = Hash::make($req->password);

     $id = User::insertGetId($data);
     Session::put('id', $id);
     Session::put('name', $req->name);
    return view('auth.login');
    }
    public function checkout(){
        $all_products = Product::where('status', 0)
        ->orderBy('HotelID','desc')
        ->get();
        return view('user.checkout',['all_products'=>$all_products]);

    }

    public function account()
    {
        $user = User::where('id', 0)
        ->orderBy('id','desc')
        ->get();
         $chitietbook=BookingDetails::get();
        return view('user.account',['chitietbook'=>$chitietbook]);
    }

    }

