<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller //todo fix
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'user_id' => 'required',
        ]);

        Comment::create($request->all());

        return redirect()->route('comments.index');
    }

    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required',
            'user_id' => 'required',
        ]);

        $comment->update($request->all());

        return redirect()->route('comments.index');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index');
    }
}
