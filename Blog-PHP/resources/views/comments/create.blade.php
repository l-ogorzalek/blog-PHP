@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Comment</h1>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="post_id">Post</label>
            <select name="post_id" id="post_id" class="form-control">
                @foreach($posts as $post)
                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
