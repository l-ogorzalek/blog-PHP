@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Profile</h1>
    <div class="card">
        <div class="card-header">
            {{ $user->name }}
        </div>
        <div class="card-body">
            <p>Email: {{ $user->email }}</p>
            <p>Registered at: {{ $user->created_at }}</p>
            <p>Role: {{ $user->role->name }}</p>
        </div>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Back to Users</a>
</div>
@endsection
