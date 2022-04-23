<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
  
    public function index()
    {
       return $posts = Post::withTrashed()->get();
    }

 
    public function create()
    {
        //
    }

   
    public function store(StorePostRequest  $request)
    {
       
       return Post::create($request->only('title', 'description', 'user_id','tags'));
    }

 
    public function show(POST $post)
    {
       return $post;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
