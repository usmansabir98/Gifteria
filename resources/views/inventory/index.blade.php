@extends('layouts.app')
@section('content')
    <h1>Inventory Products</h1>
    @if(count($inventories)> 0)

    @foreach ($inventories as $inventory)
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
    @endforeach
    {{-- {{$brands->links()}} --}}
    @else 
    <p>No Inventory items found</p>
    @endif 

    


@endsection