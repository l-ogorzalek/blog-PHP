<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $postsCount = Post::where('user_id', $user->id)->count();
        $commentsCount = Comment::where('user_id', $user->id)->count();

        return view('profile.index', compact('user', 'postsCount', 'commentsCount'));
    }
}
