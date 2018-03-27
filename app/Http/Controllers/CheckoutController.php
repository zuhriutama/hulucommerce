<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Province;

class CheckoutController extends Controller
{

    public function index()
    {
        $order = null;
        if($this->cart->status=='draft'){
            $order = Order::createFromCart($this->cart);
            $this->cart->checkout();
        }else{
            $order = Order::where('cart_id',$this->cart->id)->first();
        }

        $provinces = Province::all();

        return view('checkout', compact('order', 'provinces'));
    }
}
