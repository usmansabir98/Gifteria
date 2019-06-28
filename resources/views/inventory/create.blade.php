@extends('layouts.app')

@section('content')
    <h1>Create Inventory Item</h1>
    {{ Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
    
    <div class="form-group">
        {{Form::label('product', 'Product')}}
        <select name="product" id="product">
            <option value="" selected>Select Product</option>
        @foreach ($products as $product)
       
            <option value="{{$product->id}}">{{$product->name }}</option>
        @endforeach
    </select>              
    </div>
    
    <div class="form-group">
        {{Form::label('batchcode','Batchcode')}}
        {{Form::text('batchcode','',['class' => 'form-control', 'placeholder' => 'Batch Code'])}}
    </div>

    <div class="form-group">
        {{Form::label('quantity','Quantity')}}
        {{Form::text('quantity','',['class' => 'form-control', 'placeholder' => 'Quantity'])}}
    </div>

    <div class="form-group">
        {{Form::label('price','Price')}}
        {{Form::text('price','',['class' => 'form-control', 'placeholder' => 'price'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('isexpirable', 'Isexpirable')}}
        <select name="isexpirable" id="isexpirable">
            <option value="" selected>Select if expirable</option>
       
            <option value="yes">yes</option>
            <option value="no">no</option>
      
    </select>              
    </div>

    <div class="form-group">
        {{Form::label('expirydate','expirydate')}}
        {{Form::text('expirydate','',['class' => 'form-control', 'placeholder' => 'expirydate'])}}
    </div>

    
   

    
   

    
      

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection
      

