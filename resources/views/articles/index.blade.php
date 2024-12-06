@extends('layouts.app')

@section('title', 'Article List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Article List</h2>
        @if (auth()->user()->role == 'admin')
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Add Article</a>
        @endif
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->category->name }}</td>
                <td>
                    <a href="{{ route('articles.show', $article) }}" class="btn btn-info btn-sm">View</a>
                    @if (auth()->user()->role == 'admin')
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Confirm Deletion？')">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $articles->links() }}
@endsection
