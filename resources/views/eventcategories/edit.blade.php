@extends('layouts.app');

@section('content')
    <h1>Edit Event Category</h1>
    {{ Form::open(['action' => ['EventCategoriesController@update',$event_category->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
    
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name',$event_category->name,['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $event_category->description, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'description'])}}
    </div>

    
    {{Form::hidden('_method','PUT')}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection