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
    
        // $contents = Storage::disk('public')->get($p);
        // dd(Storage::disk('public')->exists($p) );
  
        $request->merge(['postAvatar' => $fileInRequest]);
        // dd($request->all());
        $post =Post::create($request->only('title', 'description', 'user_id','postAvatar'));
        
        return redirect()->route('posts.index')->with('success', "post created");;
    }


    public function show(Post $post)
    {

        // $post = Post::find(230);
        // dd($post->postAvatar);
        return view('posts.show', [
            'post' => $post,
        ]);
    }


    public function edit($id)
    {
        $users =  User::all();
        $post = Post::find($id);
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
