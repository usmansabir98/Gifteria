@extends('layouts.app')
@section('content')
    <h1>Brands</h1>
    @if(count($brands) > 0)

    @foreach ($brands as $brand)
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">
               
        </div>
        <div class="col-md-8 col-sm-8">
                <h3><a href="/brands/{{$brand->id}}">{{$brand->name}}</a></h3>
               
        </div>
     </div>

     
     </div>
    @endforeach
    {{-- {{$brands->links()}} --}}
    @else 
    <p>No brands found</p>
    @endif 
@endsection