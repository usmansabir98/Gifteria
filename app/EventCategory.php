<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    //
    protected $table = 'event_categories';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_eventcategory', 'product_id','eventcategory_id');
        //return $this->belongsToMany(Privileges::class);
    }
}
