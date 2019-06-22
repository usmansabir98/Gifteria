<?php

namespace App\Http\Controllers;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;


use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel!';
        //return view('pages.index',compact('title'));
        return view('pages.index') -> with('title',$title);
    }
    public function about(){
        $title = 'about us!';
       
        return view('pages.about') -> with('title',$title);
        
    }
    public function services(){
        $data = array (
            'title' => 'Services',
            'services' => ['Web Designing', 'Programming', 'SEO']
        );
        return view('pages.services') -> with($data);
    }
}

