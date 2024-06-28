@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Logs</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Message</th>
                <th>Level</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->message }}</td>
                <td>{{ $log->level }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
