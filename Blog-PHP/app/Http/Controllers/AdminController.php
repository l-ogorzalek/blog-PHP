<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $users = User::all();
        return view('admin.index', compact('posts', 'users'));
    }

    public function export()
    {
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.csv';
        $file = fopen(storage_path('app/' . $filename), 'w');

        fputcsv($file, ['Users', 'Posts', 'Comments']);

        $users = User::all();
        foreach ($users as $user) {
            fputcsv($file, [
                'User ID' => $user->id,
                'Name' => $user->name,
                'Email' => $user->email,
                'Role' => $user->role->name
            ]);
        }

        $posts = Post::all();
        foreach ($posts as $post) {
            fputcsv($file, [
                'Post ID' => $post->id,
                'Title' => $post->title,
                'Content' => $post->content,
                'Author' => $post->user->name
            ]);
        }

        $comments = Comment::all();
        foreach ($comments as $comment) {
            fputcsv($file, [
                'Comment ID' => $comment->id,
                'Content' => $comment->content,
                'Author' => $comment->user->name,
                'Post ID' => $comment->post->id
            ]);
        }

        fclose($file);

        return response()->download(storage_path('app/' . $filename));
    }
}
