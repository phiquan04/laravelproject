<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Cart;
use Session;
class CartController extends Controller
{
    public function cart()
    {
        return view('user.cart');
    }
    public function addToCart($room_id)
    {
        $product = Room::findOrFail($room_id);
        $cart = session()->get('cart', []);
        if(isset($cart[$room_id])) {
            $cart[$room_id]['quantity']++;
        }  else {
            $cart[$room_id] = [
                "room_id"=>$product->room_id,
                "room_type" => $product->room_type,
                "room_Image" => $product->room_Image,
                "room_price" => $product->room_price,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
       return redirect()->back()->with('success','Product add to cart successfully');
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
    public function update(Request $requestt)
    {
        if($requestt->id && $requestt->quantity){
            $cart = session()->get('cart');
            $cart[$requestt->id]['quantity'] = $requestt->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }


}
