@extends('layouts.app')
@section('content')
    <h1>Products</h1>
    @if(count($products)> 0)

    @foreach ($products as $product)
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">
                @foreach($product->productImages as $productImage) 
                @if($productImage->cover_flag == 1) 
                <img style="width:100%" src="/storage/cover_images/{{$productImage->imageurl}}"> 
                @endif
                @endforeach
        </div>


        <div class="col-md-8 col-sm-8">
                <h3><a href="/products/{{$product->id}}">{{$product->name}}</a></h3>
        <h2>{{$product->productCategory->name}}</h2>
        <h2>{{$product->brand->name}}</h2>

        <h2>{{$product->user->name}}</h2> 

        
        @foreach ($product->eventCategories as $eventCategory)
        <h2>{{$eventCategory->name}}</h2>
        @endforeach
               
        </div>
     </div>

     
     </div>
    @endforeach
    {{-- {{$brands->links()}} --}}
    @else 
    <p>No Products found</p>
    @endif 

    


@endsection