@extends('layouts.app')

@section('title', 'Mood Diary')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Mood Diary</h2>
        <a href="{{ route('mood-diaries.create') }}" class="btn btn-primary">Add Diary</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Mood</th>
            <th>Notes</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($diaries as $diary)
            <tr>
                <td>{{ $diary->id }}</td>
                <td>{{ $diary->mood }}</td>
                <td>{{ $diary->description }}</td>
                <td>{{ $diary->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('mood-diaries.edit', $diary) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('mood-diaries.destroy', $diary) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Confirm Deletion？')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $diaries->links('custom_pagination') }}
@endsection
