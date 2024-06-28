@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comment for: {{ $comment->post->title }}</h1>
    <p>{{ $comment->content }}</p>
    <a href="{{ route('comments.index') }}" class="btn btn-secondary">Back to Comments</a>
</div>
@endsection
