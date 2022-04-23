<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
  
    public function index()
    {
       return PostResource::collection(Post::withTrashed()->get());
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
       return new PostResource($post);
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
