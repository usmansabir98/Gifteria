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
}
