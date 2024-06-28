@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $post->title }}</h1>
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text">{{ $post->content }}</p>
        </div>
        <div class="card-footer text-muted">
            Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
        </div>
    </div>

    @if (auth()->check() && auth()->user()->id === $post->user_id)
        <div class="mt-3 d-flex justify-content-start">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    @endif

    <h3 class="mt-5">Comments</h3>
    @foreach ($post->comments as $comment)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $comment->content }}</p>
                <small class="text-muted">Posted by {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</small>
            </div>
        </div>
    @endforeach

    @auth
        <h4 class="mt-4">Add a Comment</h4>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-3">
                <textarea class="form-control" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endauth
</div>
@endsection
