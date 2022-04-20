<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // dd(Auth::user()->id);
        $comment =  Comment::create([
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'commentable_id' => $request->post_id,
            'commentable_type' => $request->parent
        ]);

        return redirect()
            ->route('posts.show', [
                'post' => $request->post_id,
            ])
            ->with('success', "your comment is added ");
    }


    public function show($id)
    {
        //
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
