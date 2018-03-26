<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{


    public function index()
    {
        $products = Product::latest()->get();
        return view('products', compact('products'));
    }

    public function detail($slug)
    {
        $product = Product::where('slug',$slug)->first();
        return view('product-detail', compact('product'));
    }
}
