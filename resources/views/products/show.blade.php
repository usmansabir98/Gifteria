@extends('layouts.app')

@section('content')
<a href="/products" class="btn btn-default">Go back</a>
    <h1>{{$product->name}}</h1>
    
   <br><br>
<div>{!!$product->description!!}</div>

</div>
<div class="col-md-8 col-sm-8">
        <h3><a href="/products/{{$product->id}}">{{$product->name}}</a></h3>
<h2>{{$product->productCategory->name}}</h2>
<h2>{{$product->brand->name}}</h2>

<h2>{{$product->user->name}}</h2> 


@foreach ($product->eventCategories as $eventCategory)
<h2>{{$eventCategory->name}}</h2>
@endforeach
 
Cover Image
@foreach($product->productImages as $productImage) 
@if($productImage->cover_flag == 1) 
<img style="width:100%" src="/storage/cover_images/{{$productImage->imageurl}}"> 
@endif
@endforeach

Gallery Images
@foreach($product->productImages as $productImage) 
@if($productImage->cover_flag == 0) 
<img style="width:100%" src="/storage/cover_images/{{$productImage->imageurl}}"> 
@endif
@endforeach


        
       
</div>
<hr>

<hr>

{{-- @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id) --}}
        <a href="/products/{{$product->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action'=> ['ProductController@destroy',$product->id],'method' =>'POST','class'=>'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('delete',['class'=>'btn btn-danger'])}}
        {{Form::close()}}
    {{-- @endif

@endif --}}
@endsection