@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">{{ $article->title }}</h1>
            <p class="text-muted">
                Category：<strong>{{ $article->category->name }}</strong> |
                Creation Time：<strong>{{ $article->created_at->format('Y-m-d H:i') }}</strong>
            </p>
            <hr>
            <div class="content">
                {!! nl2br(e($article->content)) !!}
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to List</a>
                @if (auth()->user()->role == 'admin')
                <div>
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article？')">Delete</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
