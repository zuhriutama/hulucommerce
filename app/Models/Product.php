<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'short_desc',
        'description',
        'price',
        'weight',
        'seen',
        'sold',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }

    public function thumbnail()
    {
        return $this->image();
    }

    public function image()
    {
        
        if($this->images->count()>0)
            return asset($this->images->first()->url);
        return Image::dummy();
    }
    
}
