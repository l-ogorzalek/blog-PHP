<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();
        $users = User::all();

        foreach ($posts as $post) {
            Comment::factory()->count(3)->make()->each(function($comment) use ($post, $users) {
                $comment->post_id = $post->id;
                $comment->user_id = $users->random()->id;
                $comment->save();
            });
        }
    }
}
