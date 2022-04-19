<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Models\Post;
use App\Models\User;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Storage;
use php_user_filter;

class PostController extends Controller
{



    public function index()
    {
        $posts = Post::withTrashed()->paginate(5);
        // PruneOldPostsJob::dispatch();
       
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }


    public function create()
    {
        $users =  User::all();
        return view('posts.create', [
            'users' => $users,
        ]);
    }


    public function store(StorePostRequest  $request)
    {   
        $fileInRequest = $request->file('postAvatar');

        $request->merge(['postAvatar' => $fileInRequest]);
        
        $post =Post::create($request->only('title', 'description', 'user_id','postAvatar','tags'));
        
        return redirect()->route('posts.index')->with('success', "post created");;
    }


    public function show(Post $post)
    {
       
        return view('posts.show', [
            'post' => $post,
            'tags'=>$post->tags
        ]);
    }


    public function edit(Post $post)
    {
        $tags = $post->tags->pluck('name')->implode(',');
        $users =  User::all();
        return view('posts.edit', [
            'post' => $post,
            'users' => $users,
            'tags'=>$tags
        ]);
    }


    public function update(StoreUpdateRequest $request, Post $post)
    {
        // $post->syncTags($request->tags); 
        $post->update($request->only('title', 'description', 'user_id','postAvatar','tags'));
        return redirect()->route('posts.index')->with('success', "post No.$post->id updated!");
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('danger', "post No.$post->id deleted!");
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();
        return redirect()->route('posts.index')->with('success', "post No.$id restored!");
    }
}
