<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $table = 'productimages';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;
  
    public function products(){
        return $this->belongsTo('App\Product');
        }
    


}
