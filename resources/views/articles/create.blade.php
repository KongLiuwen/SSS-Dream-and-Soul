@extends('layouts.app')

@section('title', isset($article) ? 'Edit Article' : 'Add Article')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">{{ isset($article) ? 'Edit Article' : 'Add Article' }}</h2>
            <form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST">
                @csrf
                @if (isset($article))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (isset($article) && $article->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $article->content ?? '') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($article) ? 'Update' : 'Save' }}</button>
            </form>
        </div>
    </div>
@endsection
