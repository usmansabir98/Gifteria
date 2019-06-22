<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function brands(){
        return $this->belongsTo(Brand::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }

    
    
    public function eventCategory()
    {
        return $this->belongsToMany(EventCategory::class,'product_eventcategory', 'product_id','eventcategory_id');
        //return $this->belongsToMany(Privileges::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function order(){
        return $this->belongsToMany(Order::class,'order_product','product_id','order_id')->withPivot('quantity', 'subTotal');
    }




}
