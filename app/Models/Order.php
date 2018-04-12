<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Carbon\Carbon as Carbon;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial',
        'user_id',
        'cart_id',
        'payment_address_id',
        'shipping_address_id',
        'payment_status',
        'shipping_status',
        'payment_method',
        'shipping_method',
        'paid_at',
        'shipping_cost',
        'tracking_no',
        'note',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function paymentAddress()
    {
        return $this->belongsTo('App\Models\UserAddress','payment_address_id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo('App\Models\UserAddress','shipping_address_id');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function total_price()
    {
        $total = 0;
        foreach($this->orderDetails as $detail){
            $total += $detail->subtotal();
        }

        return $total;
    }

    public function grand_total()
    {
        $total = $this->total_price();
        $total += $this->shipping_cost;
        return $total;
    }

    public function deleteDetails()
    {
        foreach($this->orderDetails as $detail)
            $detail->delete();
    }

    public static function generateSerial()
    {
        $lastOrder = Order::latest()->first();
        return 'ORD'.Carbon::now()->format('dmY').str_pad($lastOrder ? $lastOrder->id + 1 : 1, 4, '0', STR_PAD_LEFT);
    }

    public static function createFromCart($cart)
    {
        $order = Order::firstOrCreate([
            'serial'=>Carbon::now()->format('dmY').$cart->id,
            'cart_id'=>$cart->id,
            'user_id'=>$cart->user_id,
        ]);

        $order->deleteDetails();

        foreach($cart->cartDetails as $detail){
            $orderDetail = OrderDetail::firstOrCreate([
                'order_id'=>$order->id,
                'product_id'=>$detail->product_id,
                'product_name'=>$detail->product_name,
                'product_price'=>$detail->product_price,
                'product_weight'=>$detail->product_weight,
            ]);
            $orderDetail->qty = $detail->qty;
            $orderDetail->save();
        }

        return $order;
    }
    
}
