<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userPosts = Post::where('user_id', $user->id)->latest()->take(5)->get();
        $userComments = Comment::where('user_id', $user->id)->latest()->take(5)->get();
        $latestPosts = Post::latest()->take(5)->get();
        $popularPosts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();

        return view('home', compact('userPosts', 'userComments', 'latestPosts', 'popularPosts'));
    }
}
