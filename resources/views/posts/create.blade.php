@extends('layouts.app')
@section('title')
    create Post
@endsection

@section('content')

<form method="POST" action="{{ route('posts.store')}}"enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1"  class="form-label">Title</label>
        <input type="text" class="form-control" value="{{old('title')}}" name='title' id="exampleFormControlInput1" placeholder="Enter post title">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name='description' id="exampleFormControlTextarea1" rows="3">{{old('description')}}</textarea>
    </div>
    <div class="mb-3">
        <label for="formFileSm" class="form-label">post photo</label>
        <input class="form-control form-control-sm" value="{{old('postAvatar','')}}"name='postAvatar' id="formFileSm" type="file">
      </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
        <select class="form-control"name='user_id'>
            <option value="" selected>select a User</option>
            @foreach ($users as $user)
                 <option value="{{ $user->id}}">{{ $user->name}}</option>
             @endforeach
         </select>
    </div>
  <button class="btn btn-success">Create</button>
</form>
@endsection