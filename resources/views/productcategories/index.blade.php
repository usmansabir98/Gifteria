@extends('layouts.app')
@section('content')
    <h1>Product Categories</h1>
    @if(count($product_categories) > 0)

    @foreach ($product_categories as $product_category)
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">
               
        </div>
        <div class="col-md-8 col-sm-8">
                <h3><a href="/productcategories/{{$product_category->id}}">{{$product_category->name}}</a></h3>
               
        </div>
     </div>

     
     </div>
    @endforeach
    {{-- {{$brands->links()}} --}}
    @else 
    <p>No Product Categories found</p>
    @endif 
@endsection