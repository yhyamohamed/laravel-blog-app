@extends('layouts.app')
@section('title')
    show Post
@endsection

@section('content')
@if ($errors->any())
   <small  class="alert alert-info" role="alert">{{$errors->first()}}</small>
@endif
<div class="card mt-4 w-75">
    <div class="card-header">
     
      {{$post->title}}
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p><span class="fs-5 fst-italic">description : </span>{{$post->description}}</p>
       <h4> <span class="fs-5 fst-italic mb-2">creator : </span>{{$post->user->name}}</h4>
        <footer class="blockquote-footer mt-2">created At : <cite title="Source Title">{{Carbon\Carbon::createFromTimeString($post->created_at)->toDayDateTimeString()}}</cite></footer>
      </blockquote>
    </div>
  </div>
<div class="card mt-4 w-75">
    <div class="card-header bg-dark text-light">
     
      {{$post->user->name}}
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p><span class="fs-5 fst-italic">description : </span>{{$post->user->email}}</p>
        <footer class="blockquote-footer">created At : <cite title="Source Title">{{$post->human_readable_date?? now()}}</cite></footer>
      </blockquote>
    </div>
  </div>

  @endsection