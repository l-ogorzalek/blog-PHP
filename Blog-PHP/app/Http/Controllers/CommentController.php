<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        $posts = Post::all();
        return view('comments.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id) {
            return redirect()->route('comments.index')->with('error', 'You are not authorized to edit this comment.');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id) {
            return redirect()->route('comments.index')->with('error', 'You are not authorized to update this comment.');
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->user()->role->name !== 'admin' && auth()->id() !== $comment->user_id) {
            return redirect()->route('comments.index')->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}
