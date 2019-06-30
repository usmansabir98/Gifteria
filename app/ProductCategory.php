<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //
    protected $table = 'product_categories';

    protected $fillable = ['name', 'description','main_category'];
    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
