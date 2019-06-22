<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

protected $table = 'orders';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function user(){
           return $this->belongsTo(User::class);
 }

        public function orderstatus(){
                return $this->HasOne(OrderStatus::class);
            }
    public function product(){
     return $this->belongsToMany(Product::class,'order_product','order_id','product_id')->withPivot('quantity', 'subTotal');
 }

}
