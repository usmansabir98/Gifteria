<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    //
    protected $table = 'event_categories';
    protected $fillable = ['name', 'description'];
    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_event_category', 'product_id','eventcategory_id');
        //return $this->belongsToMany(Privileges::class);
    }
}
