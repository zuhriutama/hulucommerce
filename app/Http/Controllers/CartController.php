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

        $cartDetail = CartDetail::firstOrCreate([
            'product_id'=>$product->id,
            'cart_id'=>$this->cart->id,
        ]);

        $cartDetail->product_name = $product->name;
        $cartDetail->product_price = $product->price;
        $cartDetail->product_weight = $product->weight;
        $cartDetail->qty++;
        $cartDetail->save();

        return back()->with('success','Added to Cart!');
    }

    public function removeProduct($id)
    {
        $item = CartDetail::find($id);
        if($item)
            $item->delete();

        return back()->with('success','Removed from Cart!');
    }


    public function buyProduct($slug)
    {
        $product = Product::where('slug',$slug)->first();

        $cartDetail = CartDetail::firstOrCreate([
            'product_id'=>$product->id,
            'cart_id'=>$this->cart->id,
        ]);

        $cartDetail->product_name = $product->name;
        $cartDetail->product_price = $product->price;
        $cartDetail->product_weight = $product->weight;
        $cartDetail->qty++;
        $cartDetail->save();

        return redirect('checkout');
    }
}
