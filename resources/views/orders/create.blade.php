@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>
    {{ Form::open(['action' => 'OrderController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
    
    
  
    <div class="form-group">
        {{Form::label('inventories', 'Inventories')}}
        <select name="inventories" id="inventories">
            <option value="" selected>Select</option>
        @foreach ($inventories as $inventory)
        <option value="{{$inventory->id }}">{{$inventory->product->name }}Rs.{{$inventory->price}}</option>
        @endforeach
    </select>              
    </div>

    
        
        

   

   

    
      

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection
      

