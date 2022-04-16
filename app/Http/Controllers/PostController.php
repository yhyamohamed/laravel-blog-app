<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
class PostController extends Controller
{

   

    public function index()
    {
      
        return view('posts.index',[
            'posts' => Posts::getAllPosts(),
        ]);
    }


    public function create()
    {
        return view('posts.create');
    }

 
    public function store(Request $request)
    {
        $index =  count(Posts::getAllPosts())+1;
        $postToadd = Array(
            'id'=>$index,
            'title' =>$request->title,
            'created_at'=>$request->created_at,
            'desc'=>$request->desc
        );
            Posts::addPost($postToadd);
            return redirect()->route('show', ['post' => $index-1])->withErrors('message', 'post addd successfully!');
    }

  
    public function show($id)
    {
        $post = Posts::findPost($id);
        return view('posts.show',[
            'post' =>$post ,
        ]);
    }


    public function edit($id)
    {
        
    }

  
    public function update(Request $request, $id)
    {
       
    }

   
    public function destroy($id)
    {
       
    }
 
}
