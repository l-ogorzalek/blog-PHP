@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>

                <div class="card-body">
                    <h5>{{ __('Name:') }} {{ $user->name }}</h5>
                    <h5>{{ __('Email:') }} {{ $user->email }}</h5>
                    <h5>{{ __('Registered on:') }} {{ $user->created_at->format('d M Y') }}</h5>
                    <h5>{{ __('Number of posts:') }} {{ $postsCount }}</h5>
                    <h5>{{ __('Number of comments:') }} {{ $commentsCount }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
