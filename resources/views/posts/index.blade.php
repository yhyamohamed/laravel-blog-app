@extends('layouts.app')
@section('title')
    home
@endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>

    </div>
    <div class="text-center mt-4">
        <x-button type="success" txt="lol-its-ablad-component" />
    </div>



    <table class="table mt-4 table-hover table-striped bg-white">
        <thead>
            <tr class="table-info">
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
            @foreach ($posts as $post)
                <tr @if ($post->trashed()) class="table-danger" @endif>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->human_readable_date }}</td>

                    <td>

                        @if ($post->trashed())
                            <form action="{{ route('posts.restore', ['post' => $post->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="col-8  btn btn-success">restore</button>
                            </form>
                        @else
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#moadal{{ $post->id }}">
                                delete
                            </button>
                        @endif



                    </td>
                </tr>
            @endforeach
        </thead>
        <tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    @foreach ($posts as $post)
        <!-- Modal -->
        <div class="modal fade" id="moadal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">deleting post NO.{{ $post->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        are you SURE ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('posts.delete', ['post' => $post->id]) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
