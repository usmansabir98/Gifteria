<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    //
    protected $table = 'order_statuses';

    protected $fillable = ['name','description'];

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;


    public function order(){
        return $this->belongsToMany(Order::class);
    }
}
