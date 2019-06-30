<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

protected $table = 'orders';
  protected $fillable = ['user_id','date_of_order','expected_delivery_date','total_cost',
 'additional_info','billing_address','postal_code','status_id'];
    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function user(){
           return $this->belongsTo(User::class);
 }

    public function orderstatus(){
                return $this->HasOne(OrderStatus::class);
    }
    public function inventories(){
     return $this->belongsToMany(Inventory::class,'order_inventory','order_id','inventory_item_id')->withPivot('quantity', 'subTotal');
 }

}
