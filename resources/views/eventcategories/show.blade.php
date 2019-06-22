@extends('layouts.app');

@section('content')
<a href="/eventcategories" class="btn btn-default">Go back</a>
    <h1>{{$event_category->name}}</h1>
    
   <br><br>
<div>{!!$event_category->description!!}</div>
<hr>

<hr>

{{-- @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id) --}}
        <a href="/eventcategories/{{$event_category->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action'=> ['EventCategoriesController@destroy',$event_category->id],'method' =>'POST','class'=>'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('delete',['class'=>'btn btn-danger'])}}
        {{Form::close()}}
    {{-- @endif

@endif --}}
@endsection