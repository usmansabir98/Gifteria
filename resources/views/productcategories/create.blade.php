@extends('layouts.app');

@section('content')
    <h1>Create ProductCategories</h1>
    {{ Form::open(['action' => 'ProductCategoriesController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
    
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', '', ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'description'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('maincategory', 'Maincategory')}}
        <select name="maincategory" id="maincategory">
            <option value="" selected>Select</option>
        @foreach ($maincategories as $maincategory)
            <option value="{{$maincategory->id }}">{{$maincategory->name }}</option>
        @endforeach
    </select>              
    </div>


      

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection