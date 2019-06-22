<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //
    protected $table = 'product_categories';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
