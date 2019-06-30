<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    // Primary Key
    protected $fillable = ['name','description', 'product_category_id','brand_id','user_id'];
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    
    
    public function eventCategories()
    {
        return $this->belongsToMany(EventCategory::class,'product_event_category', 'product_id','eventcategory_id');
        //return $this->belongsToMany(Privileges::class);
    }
     
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
        
    }

    public function inventory(){
        return $this->hasMany(Inventory::class);
    }

   



}
