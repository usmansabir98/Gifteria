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
    public function inventory(){
     return $this->belongsToMany(Inventory::class,'order_inventory','order_id','inventoryitem_id')->withPivot('quantity', 'subTotal');
 }

}
