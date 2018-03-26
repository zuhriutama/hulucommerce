<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartDetail;

class CartController extends Controller
{

    public function index()
    {
        return view('cart');
    }

    public function addProduct($slug)
    {
        $product = Product::where('slug',$slug)->first();

        $cart = Cart::firstOrCreate([
            'user_id'=>\Auth::user()->id,
            'status'=>'draft',
        ]);

        $cartDetail = CartDetail::firstOrCreate([
            'product_id'=>$product->id,
            'cart_id'=>$cart->id,
        ]);

        $cartDetail->product_name = $product->name;
        $cartDetail->product_price = $product->price;
        $cartDetail->product_weight = $product->weight;
        $cartDetail->qty++;
        $cartDetail->save();

        return back()->with('success','Added to Cart!');
    }
}
