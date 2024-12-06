@extends('layouts.app')

@section('title', 'Edit Mood Diary')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Edit Mood Diary</h2>
            <form action="{{ route('mood-diaries.update', $moodDiary) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="mood" class="form-label">Mood</label>
                    <select class="form-control" id="mood" name="mood" required>
                        <option value="very_happy" {{ $moodDiary->mood == 'very_happy' ? 'selected' : '' }}>Very Happy （100）</option>
                        <option value="excited" {{ $moodDiary->mood == 'excited' ? 'selected' : '' }}>Excited （90）</option>
                        <option value="happy" {{ $moodDiary->mood == 'happy' ? 'selected' : '' }}>Happy （80）</option>
                        <option value="grateful" {{ $moodDiary->mood == 'grateful' ? 'selected' : '' }}>Grateful （80）</option>
                        <option value="content" {{ $moodDiary->mood == 'content' ? 'selected' : '' }}>Content （70）</option>
                        <option value="calm" {{ $moodDiary->mood == 'calm' ? 'selected' : '' }}>Calm （60）</option>
                        <option value="neutral" {{ $moodDiary->mood == 'neutral' ? 'selected' : '' }}>Neutral （50）</option>
                        <option value="slightly_sad" {{ $moodDiary->mood == 'slightly_sad' ? 'selected' : '' }}>Slightly Sad （40）</option>
                        <option value="anxious" {{ $moodDiary->mood == 'anxious' ? 'selected' : '' }}>Anxious （40）</option>
                        <option value="sad" {{ $moodDiary->mood == 'sad' ? 'selected' : '' }}>Sad （30）</option>
                        <option value="lonely" {{ $moodDiary->mood == 'lonely' ? 'selected' : '' }}>Lonely （30）</option>
                        <option value="very_sad" {{ $moodDiary->mood == 'very_sad' ? 'selected' : '' }}>Very Sad （20）</option>
                        <option value="exhausted" {{ $moodDiary->mood == 'exhausted' ? 'selected' : '' }}>Exhausted （20）</option>
                        <option value="angry" {{ $moodDiary->mood == 'angry' ? 'selected' : '' }}>Angry （30）</option>
                        <option value="very_angry" {{ $moodDiary->mood == 'very_angry' ? 'selected' : '' }}>Very Angry （10）</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Notes</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $moodDiary->description) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
