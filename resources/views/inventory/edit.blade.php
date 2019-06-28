

@extends('layouts.app')

@section('content')
    <h1>Edit Inventory </h1>
    {{ Form::open(['action' => ['InventoryController@update',$inventory_item->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
    
     <div class="form-group">
        {{Form::label('product', 'Product')}}
        <select name="product" id="product">
            <option value="" selected>Select Product</option>
        @foreach ($products as $product)
       
            <option @if(old('product',$inventory_item->product_id) == $product->id) selected @endif value="{{$product->id}}">{{$product->name }}</option>
        @endforeach
    </select>              
    </div>

    
    
    <div class="form-group">
        {{Form::label('batchcode','Batchcode')}}
        {{Form::text('batchcode',$inventory_item->batch_code,['class' => 'form-control', 'placeholder' => 'Batch Code'])}}
    </div>

    
    <div class="form-group">
        {{Form::label('quantity','Quantity')}}
        {{Form::text('quantity',$inventory_item->quantity,['class' => 'form-control', 'placeholder' => 'Quantity'])}}
    </div>

    

    <div class="form-group">
        {{Form::label('price','Price')}}
        {{Form::text('price',$inventory_item->price,['class' => 'form-control', 'placeholder' => 'price'])}}
    </div>
    
    
    <div class="form-group">
        {{Form::label('isexpirable', 'Isexpirable')}}
        <select name="isexpirable" id="isexpirable">
            <option value="" selected>Select If expirable</option>
       
            <option 
            @if(old('isexpirable',$inventory_item->is_expirable) == "yes") selected @endif value="yes">yes</option>
            <option @if(old('isexpirable',$inventory_item->is_expirable) == "no") selected @endif value="no">no</option>
      
    </select>              
    </div>

    

    <div class="form-group">
        {{Form::label('expirydate','expirydate')}}
        {{Form::text('expirydate', 
       
        $inventory_item->expiry_date 
        ,['class' => 'form-control', 'placeholder' => 'expirydate'])}}
    </div> 

    
    {{Form::hidden('_method','PUT')}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection