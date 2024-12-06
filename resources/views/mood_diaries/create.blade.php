@extends('layouts.app')

@section('title', 'Add Mood Diary')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Add Mood Diary</h2>
            <form action="{{ route('mood-diaries.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="mood" class="form-label">Mood</label>
                    <select class="form-control" id="mood" name="mood" required>
                        <option value="very_happy">Very Happy （100）</option>
                        <option value="excited">Excited （90）</option>
                        <option value="happy">Happy （80）</option>
                        <option value="grateful">Grateful （80）</option>
                        <option value="content">Content （70）</option>
                        <option value="calm">Calm （60）</option>
                        <option value="neutral">Neutral （50）</option>
                        <option value="slightly_sad">Slightly Sad （40）</option>
                        <option value="anxious">Anxious （40）</option>
                        <option value="sad">Sad （30）</option>
                        <option value="lonely">Lonely （30）</option>
                        <option value="very_sad">Very Sad （20）</option>
                        <option value="exhausted">Exhausted （20）</option>
                        <option value="angry">Angry （30）</option>
                        <option value="very_angry">Very Angry （10）</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Notes</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
