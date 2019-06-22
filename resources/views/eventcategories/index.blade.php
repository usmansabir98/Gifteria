@extends('layouts.app')
@section('content')
    <h1>Event Categories</h1>
    @if(count($event_categories) > 0)

    @foreach ($event_categories as $event_category)
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">
               
        </div>
        <div class="col-md-8 col-sm-8">
                <h3><a href="/eventcategories/{{$event_category->id}}">{{$event_category->name}}</a></h3>
               
        </div>
     </div>

     
     </div>
    @endforeach
    {{-- {{$brands->links()}} --}}
    @else 
    <p>No Event Categories found</p>
    @endif 
@endsection