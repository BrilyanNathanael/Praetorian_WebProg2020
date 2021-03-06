<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id','name', 'price', 'stock', 'image',
    ];

    public function category()
    {
        return $this -> belongsTo('App\Category');
    }
    
}
