<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    //
    protected $table = 'privileges';

    // Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function roles()
    {
       // return $this->belongsToMany(Role::class);
        return $this->belongsToMany(Role::class,'role_privilege', 'privilege_id',  'role_id');
    }
}
