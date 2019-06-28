@extends('layouts.app')
@section('content')
    <h1>Order status</h1>
   
     <div class="card card-body bg-light">

     <div class="row">
        <div class="col-md-4 col-sm-4">


                


        </div>


        <div class="col-md-8 col-sm-8">
                <h3>{{$orderstatus->name}}</h3>
        <h2>{{$orderstatus->description}}</h2>
        
        {{-- @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id) --}}
    <a href="/orderstatus/{{$orderstatus->id}}/edit" class="btn btn-default">Edit</a>

    {!!Form::open(['action'=> ['OrderStatusController@destroy',$orderstatus->id],'method' =>'POST','class'=>'pull-right'])!!}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('delete',['class'=>'btn btn-danger'])}}
    {{Form::close()}}
{{-- @endif

@endif --}}
               
        </div>
     </div>

     
     </div>
    

    


@endsection