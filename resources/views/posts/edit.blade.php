@extends('layouts.app')
@section('title')
    Edit Post
@endsection

@section('content')

<form method="POST" action="{{ route('posts.update',['post'=>$post->id])}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleFormControlInput1"  class="form-label">Title</label>
        <input type="text" class="form-control" name='title' id="exampleFormControlInput1" value="{{ $post->title}}">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name='description' id="exampleFormControlTextarea1" rows="3">{{ $post->description}}</textarea>
    </div>
    <div class="mb-3">
        <label for="formFileSm" class="form-label">post photo</label>
        <input class="form-control form-control-sm" value="{{old('postAvatar','')}}"name='postAvatar' id="formFileSm" type="file">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1"  class="form-label">tags</label>
        {{-- {{dd($tags->toArray())}} --}}
        @if ($tags)
        <input type="text" class="form-control" value="{{$tags}}" name='tags' id="exampleFormControlInput1" placeholder="Enter comma seperated tags">

        @else
        <input type="text" class="form-control" value="{{old('tags')}}" name='tags' id="exampleFormControlInput1" placeholder="Enter comma seperated tags">
        @endif
    </div>  
   
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
        
        <select class="form-control"name='user_id'>
           @foreach ($users as $user)
                <option value="{{ $user->id}}">{{ $user->name}}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" class="form-control" name='created_at' value="{{now()}}">

  <button class="btn btn-success">Update</button>
</form>
@endsection