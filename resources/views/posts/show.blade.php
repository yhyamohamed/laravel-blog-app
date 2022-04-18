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
    <div class="row card-body">
      <div class="col-8">
      <blockquote class="blockquote mb-0">
        <p><span class="fs-5 fst-italic">description : </span>{{$post->description}}</p>
       <h4> <span class="fs-5 fst-italic mb-2">creator : </span>{{$post->user->name}}</h4>
        <footer class="blockquote-footer mt-2">created At : <cite title="Source Title">{{Carbon\Carbon::createFromTimeString($post->created_at)->toDayDateTimeString()}}</cite></footer>
      </blockquote></div>
      <div class="col-4">
      <img src="{{ asset( $post->postAvatar ?? 'default.jpg') }}" class="rounded float-end card-img-top" alt="...">
      </div>
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

  @foreach ($post->comment as $comment)
  <div class="row w-75 mt-4 bg-success p-1 text-dark bg-opacity-25">
    <div class="row col-12">
      <div class="col-8">
        <p class="col-8 font-weight-normal m-1"> {{$comment->body}}</p> 
        <strong class="text-muted">written By: {{$comment->commentable->user->name}}</strong>
      </div>
      <div class="row col-4">
        <span class=" offset-4 text-right font-italic"
        >{{$comment->created_at->diffForHumans()}}</span>
       
        <button class="btn btn-sm p-0 text-light rounded border border-success btn-warning col " href="">EDIT</button>
        <form class="d-inline col p-0 " method="POST" style="margin-left: 2px">
            <button class=" w-100 h-100 btn btn-danger border border-info ">DELETE</button>
        </form>
        </div>
    </div>
</div>
  @endforeach

  @endsection