<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Cart;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $cart;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (\Auth::check()) {
                $this->cart = Cart::where('user_id', \Auth::user()->id)
                    ->latest()
                    ->first();

                if(!$this->cart || $this->cart->status=='thankyou'){
                    $this->cart = Cart::create([
                        'user_id'=>\Auth::user()->id,
                        'status'=>'draft',
                    ]);
                }
            } else {
                $this->cart = null;
            }

            view()->share('cart', $this->cart);

            return $next($request);
        });
    }
}
