<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Table name
    protected $fillable = ['name', 'description'];

    protected $table = 'brands';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function products(){
        return $this->hasMany(Product::class);
    }

}
