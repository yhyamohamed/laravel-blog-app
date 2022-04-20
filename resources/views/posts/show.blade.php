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
      @forelse ($tags as $tag)
      <button class="button rounded btn btn-outline-success btn-sm">
        {{$tag->name}}
      </button>
      @empty
      <small class="w-75 alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          no tags added for that post
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
          </symbol>
          <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </symbol>
        </svg>
      </small>
    
      @endforelse
     
      </blockquote>
    </div>
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
<div class="card mt-3 w-75">
  <div class="card-header bg-secondary text-light">
Add acomment
  </div>
  <form action="{{route('comments.store')}}"
      method="POST"
       class="row col-10 offset-1 my-2 d-flex justify-content-center" >
       @csrf
    <div class="col-lg-9  col-sm-12">
      <input id="input-msg" class="form-control border border-success shadow-sm p-2 mb-1"
       type="text" 
       onfocus="this.placeholder = ''"
      onblur="this.placeholder ='Enter  your comment'"
      placeholder ='Enter your comment'
       aria-label="default input" autocomplete="off" 
       name="body"/>
    </div>
    <input type="hidden" name="post_id"  value="{{ $post->id }}" />
    <input type="hidden" name="parent"  value="App\Models\Post" />
    <button type="submit" id="send-btn" class="btn btn-success ms-2 col-lg-2 col-sm-8">
      <i class="fa-solid fa-paper-plane"></i>
       comment</button>
  </form>
</div>
  @foreach ($post->comment as $comment)
  <div class="row w-75 mt-4 bg-primary p-1 text-dark bg-opacity-25">
    <div class="row col-12" style="min-height: 80px;">
      <div class="col-8">
        <p class="col-8 font-weight-normal m-1"> {{$comment->body}}</p> 
        <strong class="text-muted">written By: {{$comment->commentable->user->name}}</strong>
      </div>
      <div class="row col-4">
        <span class=" offset-4 text-right font-italic"
        >{{$comment->created_at->diffForHumans()}}</span>
       
        <button class="btn btn-sm p-0 w-75 text-light rounded border border-success btn-warning col " href="">EDIT</button>
   
        <form class="d-inline col p-0 " method="POST" style="margin-left: 2px">
            <button class=" w-75  btn btn-danger border border-info ">DELETE</button>
        </form>
        </div>
    </div>
</div>
  @endforeach

  @endsection