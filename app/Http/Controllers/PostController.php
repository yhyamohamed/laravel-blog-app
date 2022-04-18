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
        $users =  User::all();
        return view('posts.edit', [
            'post' => $post,
            'users' => $users,
        ]);
    }


    public function update(StoreUpdateRequest $request, $id)
    {
        request()->validate([
            'title' => 'required',
        ]);
        $post = Post::find($id);

        $post->id = $id;
        $post->title  = $request->title;
        $post->user_id = $request->user_id;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->save();

        return redirect()->route('posts.index')->with('success', "post No.$id updated!");
    }


    public function destroy($id)
    {

        Post::where('id', $id)->delete();
        return redirect()->route('posts.index')->with('danger', "post No.$id deleted!");
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();
        return redirect()->route('posts.index')->with('success', "post No.$id restored!");
    }
}
