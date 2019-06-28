@extends('layouts.app')
@section('content')
    <h1>Inventory Product</h1>
   
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">
               Product Name: {{$inventory->product->name}}
                Quantity: {{$inventory->quantity}}
               Price: {{$inventory->price}}

                @foreach($inventory->product->productImages as $productImage) 
                @if($productImage->cover_flag == 1) 
                <img style="width:100%" src="/storage/cover_images/{{$productImage->imageurl}}"> 
                @endif
                @endforeach

                


        </div>


         <div class="col-md-8 col-sm-8">
                {{-- <h3><a href="/products/{{$inventory->product->id}}">{{$product->name}}</a></h3> --}}
        Product Category:<h2>{{$inventory->product->productCategory->name}}</h2>
        Product Brand <h2>{{$inventory->product->brand->name}}</h2>

       Vendor: <h2>{{$inventory->product->user->name}}</h2> 

        For Events:
       @foreach ($inventory->product->eventCategories as $eventCategory)
        <h2>{{$eventCategory->name}}</h2>
        @endforeach
               
        </div>
     </div>

     
     </div>
   

    
   {{-- @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id) --}}
    <a href="/inventory/{{$inventory->id}}/edit" class="btn btn-default">Edit</a>

    {!!Form::open(['action'=> ['InventoryController@destroy',$inventory->id],'method' =>'POST','class'=>'pull-right'])!!}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('delete',['class'=>'btn btn-danger'])}}
    {{Form::close()}}
{{-- @endif

@endif --}}

@endsection