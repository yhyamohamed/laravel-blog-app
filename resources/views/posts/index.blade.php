@extends('layouts.app')
@section('title')
    home
@endsection

@section('content')
<div class="text-center">
    <a href="{{ route('createApost') }}" class="mt-4 btn btn-success">Create Post</a>
</div>
<table class="table mt-4 table-hover" >
    <thead>
      <tr class="table-info">
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
      @foreach ($posts as $post)
        <tr>
            <td>{{ $post['id']}}</td>
            <td>{{ $post['title']}}</td>
            <td>{{ $post['post_creator']}}</td>
            <td>{{ $post['created_at']}}</td>
          
            <td>
                <a href="{{ route('show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                <a href="#" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
            </td>
        </tr>
      @endforeach
    </thead>
    <tbody>
@endsection