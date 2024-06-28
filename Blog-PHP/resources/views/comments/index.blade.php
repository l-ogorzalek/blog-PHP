@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comments</h1>
    @foreach($comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <p>{{ $comment->content }}</p>
                <small class="text-muted">by {{ $comment->user->name }}</small>

                @if (auth()->check() && auth()->user()->id === $comment->user_id)
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                @endif

                @if (auth()->check() && auth()->user()->role->name == 'admin')
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
