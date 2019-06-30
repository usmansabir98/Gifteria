<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $table = 'product_images';

    protected $fillable = ['imageurl', 'product_id','cover_flag'];

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;
  
    public function product(){
        return $this->belongsTo('App\Product');
        }
    


}
