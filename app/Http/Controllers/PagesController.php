<?php

namespace App\Http\Controllers;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;


use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel!';
        

       return response() -> json($title);
        //return $title->toJson();
    }
    
}

