@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Posts</h1>
    @if(auth()->user()->role->name === 'author')
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">{{ __('Create New Post') }}</a>
    @endif
    <div class="list-group">
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ $post->title }}</h5>
                <p class="mb-1">{{ $post->content }}</p>
                <small>Posted by {{ $post->user->name }}</small>
            </a>
        @endforeach
    </div>
</div>
@endsection
