@extends('layouts.app');

@section('content')
    <h1>Edit Product Category</h1>
    {{ Form::open(['action' => ['ProductCategoriesController@update',$product_category->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
    
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name',$product_category->name,['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $product_category->description, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'description'])}}
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

    
    {{Form::hidden('_method','PUT')}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection