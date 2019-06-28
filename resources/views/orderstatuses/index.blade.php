@extends('layouts.app')
@section('content')
    <h1>Order statuses</h1>
    @if(count($orderstatuses)> 0)

    @foreach ($orderstatuses as $orderstatus)
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">


                


        </div>


        <div class="col-md-8 col-sm-8">
                <h3><a href="/orderstatus/{{$orderstatus->id}}">{{$orderstatus->name}}</a></h3>
        <h2>{{$orderstatus->description}}</h2>
        
               
        </div>
     </div>

     
     </div>
    @endforeach
    {{-- {{$brands->links()}} --}}
    @else 
    <p>No statuses found</p>
    @endif 

    


@endsection