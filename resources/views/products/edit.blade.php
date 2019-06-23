@extends('layouts.app');

@section('content')
    <h1>Edit Product </h1>
    {{ Form::open(['action' => ['ProductController@update',$product->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
    
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name',$product->name,['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $product->description, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'description'])}}
    </div>

    <div class="form-group">
        {{Form::label('productcategory', 'Productcategory')}}
        <select name="productcategory" id="productcategory">
            <option value="" selected>Select</option>
        @foreach ($product_categories as $product_category)
            <option @if(old('productcategory',$product->product_category_id) == $product_category->id) selected @endif value="{{$product_category->id }}">{{$product_category->name }}</option>
        @endforeach
    </select>              
    </div>

   

    

    <div class="form-group">
        {{Form::label('eventcategory', 'Eventcategory')}}
           
        @foreach ($event_categories as $event_category)
        <input @if($product->eventCategories->contains($event_category->id)) checked=checked @endif type="checkbox" name="event_category[]"  value="{{$event_category->id }}" /> {{$event_category->name }}
        @endforeach
    </select>              
    </div>
    

    <div class="form-group">
        {{Form::label('brand', 'Brand')}}
        <select name="brand" id="brand">
            <option value="" selected>Select</option>
        @foreach ($brands as $brand)
       
            <option @if(old('brand',$product->brand_id) == $brand->id) selected @endif  value="{{$brand->id }}">{{$brand->name }}</option>
        @endforeach
    </select>              
    </div>

    
    {{Form::hidden('_method','PUT')}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection