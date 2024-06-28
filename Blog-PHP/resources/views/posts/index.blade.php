@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>

    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="author_id">Filter by Author</label>
                    <select name="author_id" id="author_id" class="form-control">
                        <option value="">All Authors</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sort_by">Sort By</label>
                    <select name="sort_by" id="sort_by" class="form-control">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
                        <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="order">Order</label>
                    <select name="order" id="order" class="form-control">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="search">Search</label>
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Apply</button>
            </div>
        </div>
    </form>

    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
@endsection
