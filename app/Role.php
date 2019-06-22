<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    // Table name
    protected $table = 'roles';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function users(){
    return $this->hasMany('App\User');
    }

    public function eventCategory()
    {
        return $this->belongsToMany(EventCategory::class,'product_eventcategory', 'product_id','eventcategory_id');
        //return $this->belongsToMany(Privileges::class);
    }
}

