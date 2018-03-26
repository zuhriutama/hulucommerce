<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
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
        return $this->belongsToMany('App\Models\User');
    }

    public function cartDetails()
    {
        return $this->hasMany('App\Models\CartDetail');
    }

    public function total()
    {
        $total = 0;
        foreach($this->cartDetails as $detail){
            $total += $detail->subtotal();
        }
        return $total;
    }
    
}
