@extends('layouts.app');

@section('content')
<a href="/productcategories" class="btn btn-default">Go back</a>
    <h1>{{$product_category->name}}</h1>
    
   <br><br>
<div>{!!$product_category->description!!}</div>
<hr>

<hr>

{{-- @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id) --}}
        <a href="/productcategories/{{$product_category->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action'=> ['ProductCategoriesController@destroy',$product_category->id],'method' =>'POST','class'=>'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('delete',['class'=>'btn btn-danger'])}}
        {{Form::close()}}
    {{-- @endif

@endif --}}
@endsection