<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Province;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;

class CheckoutController extends Controller
{

    public function index()
    {
        $order = null;
        $order = Order::createFromCart($this->cart);
        $order = Order::find($order->id);

        $provinces = Province::all();

        $step = 'shipping';

        return view('checkout-address', compact('order', 'provinces', 'step'));
    }

    public function shipping(Request $request)
    {
        $this->validate($request, [
            'payment_address' => 'required',
            'shipping_address' => 'required',
        ]);

        $order = Order::where('user_id',\Auth::user()->id)
        ->where('payment_status','unpaid')
        ->latest()
        ->first();

        $shippingMethods = ShippingMethod::all();

        $step = 'payment';

        return view('checkout-shipping', compact('order', 'shippingMethods', 'step'));
    }

    public function payment(Request $request)
    {
        $this->validate($request, [
            'shipping_id' => 'required',
        ]);

        $order = Order::where('user_id',\Auth::user()->id)
        ->where('payment_status','unpaid')
        ->latest()
        ->first();

        $order->shipping_method_id = $request->get('shipping_id');
        $order->save();

        $paymentMethods = PaymentMethod::all();

        $step = 'finish';

        return view('checkout-payment', compact('order', 'paymentMethods', 'step'));
    }

    public function finish(Request $request)
    {
        $this->validate($request, [
            'payment_id' => 'required',
        ]);

        $order = Order::where('user_id',\Auth::user()->id)
        ->where('payment_status','unpaid')
        ->latest()
        ->first();

        $cart = $order->cart;
        $cart->status = 'thankyou';
        $cart->save();

        $order->payment_method_id = $request->get('payment_id');
        $order->payment_status = 'waiting';
        $order->save();

        return redirect('thankyou')->with('order',$order);
    }

    public function thankyou()
    {
        if(session()->has('order')){
            $order = session()->get('order');

            return view('thankyou', compact('order'));
        }

        return back();
    }

    public function setAddress(Request $request)
    {
        $order = Order::find($request->get('order_id'));
        if($order){
            if($request->get('type')=='payment')
                $order->payment_address_id = $request->get('address_id');
            else
                $order->shipping_address_id = $request->get('address_id');

            $order->save();
        }

        return back();
    }
}
