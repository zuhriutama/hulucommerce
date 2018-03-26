<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_name',
        'product_price',
        'product_weight',
        'qty',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function subtotal()
    {
        return $this->product_price*$this->qty;
    }
    
}
