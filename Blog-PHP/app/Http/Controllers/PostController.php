<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:author')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('author_id') && $request->author_id != '') {
            $query->where('user_id', $request->author_id);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('content', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->has('sort_by')) {
            $sort_by = $request->sort_by;
            $query->orderBy($sort_by, $request->get('order', 'asc'));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $posts = $query->paginate(10);
        $authors = User::whereHas('posts')->get();

        return view('posts.index', compact('posts', 'authors'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $previous = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $next = Post::where('id', '>', $post->id)->orderBy('id')->first();
        
        return view('posts.show', compact('post', 'previous', 'next'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to update this post.');
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
