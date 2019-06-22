@extends('layouts.app');

@section('content')
<a href="/brands" class="btn btn-default">Go back</a>
    <h1>{{$brand->name}}</h1>
    
   <br><br>
<div>{!!$brand ->description!!}</div>
<hr>

<hr>

{{-- @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id) --}}
        <a href="/brands/{{$brand->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action'=> ['BrandsController@destroy',$brand->id],'method' =>'POST','class'=>'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('delete',['class'=>'btn btn-danger'])}}
        {{Form::close()}}
    {{-- @endif

@endif --}}
@endsection