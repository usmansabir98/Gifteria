@extends('layouts.app')
@section('content')
    <h1>Orders</h1>
    @if(count($orders)> 0)

    @foreach ($orders as $order)
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">


                


        </div>


        <div class="col-md-8 col-sm-8">
                <h3><a href="/orders/{{$order->id}}">{{$order->id}}</a></h3>
        
        
               
        </div>
     </div>

     
     </div>
    @endforeach
    {{-- {{$brands->links()}} --}}
    @else 
    <p>No statuses found</p>
    @endif 

    


@endsection