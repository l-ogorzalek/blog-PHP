@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->role->name === 'author')
                        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">{{ __('Create New Post') }}</a>
                    @endif

                    <ul class="list-group">
                        @foreach ($posts as $post)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                                    <small class="text-muted">by {{ $post->user->name }}</small>
                                </div>
                                @if (auth()->id() === $post->user_id)
                                    <div>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
