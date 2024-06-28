@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h3>{{ __('Your Recent Posts') }}</h3>
                    @if($userPosts->isEmpty())
                        <p>You haven't created any posts yet.</p>
                    @else
                        <ul>
                            @foreach($userPosts as $post)
                                <li>
                                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a> - {{ $post->created_at->format('d M Y') }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h3>{{ __('Your Recent Comments') }}</h3>
                    @if($userComments->isEmpty())
                        <p>You haven't commented on any posts yet.</p>
                    @else
                        <ul>
                            @foreach($userComments as $comment)
                                <li>
                                    On <a href="{{ route('posts.show', $comment->post_id) }}">{{ $comment->post->title }}</a> - {{ $comment->created_at->format('d M Y') }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h3>{{ __('Latest Posts') }}</h3>
                    <ul>
                        @foreach($latestPosts as $post)
                            <li>
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a> - {{ $post->created_at->format('d M Y') }}
                            </li>
                        @endforeach
                    </ul>

                    <h3>{{ __('Most Popular Posts') }}</h3>
                    <ul>
                        @foreach($popularPosts as $post)
                            <li>
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a> - {{ $post->comments_count }} comments
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
