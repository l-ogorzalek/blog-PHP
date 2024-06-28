@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image (optional)</label>
                            <input type="file" name="image" class="form-control">
                            @if ($post->image)
                                <img src="{{ asset($post->image) }}" class="img-fluid mt-3" alt="{{ $post->title }}">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <div class="form-group mt-3">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
