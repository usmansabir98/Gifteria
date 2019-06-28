<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table = 'inventories';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsToMany(Order::class,'order_product','product_id','order_id')->withPivot('quantity', 'subTotal');
    }

}
