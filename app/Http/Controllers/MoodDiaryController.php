<?php

namespace App\Http\Controllers;

use App\Models\MoodDiary;
use Illuminate\Http\Request;

class MoodDiaryController extends Controller
{
    public function index()
    {
        $diaries = MoodDiary::where('user_id', auth()->id())->latest()->paginate(10);
        return view('mood_diaries.index', compact('diaries'));
    }

    public function create()
    {
        return view('mood_diaries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        MoodDiary::create([
            'user_id' => auth()->id(),
            'mood' => $request->mood,
            'description' => $request->description,
        ]);

        return redirect()->route('mood-diaries.index')->with('success', 'Emotion diary entry recorded successfully！');
    }


    public function edit(MoodDiary $moodDiary)
    {
        $this->authorize('update', $moodDiary); 
        return view('mood_diaries.edit', compact('moodDiary'));
    }


    public function update(Request $request, MoodDiary $moodDiary)
    {
        $this->authorize('update', $moodDiary);

        $request->validate([
            'mood' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $moodDiary->update($request->all());
        return redirect()->route('mood-diaries.index')->with('success', 'Emotion diary entry updated successfully！');
    }


    public function destroy(MoodDiary $moodDiary)
    {
        $this->authorize('delete', $moodDiary);
        $moodDiary->delete();
        return redirect()->route('mood-diaries.index')->with('success', 'Emotion diary entry deleted successfully！');
    }

    public function chartData()
    {

        $moodMapping = [
            "very_happy" => 100, 
            "excited" => 90,     
            "happy" => 80,       
            "grateful" => 80,    
            "content" => 70,     
            "calm" => 60,        
            "neutral" => 50,     
            "slightly_sad" => 40,
            "anxious" => 40,     
            "sad" => 30,         
            "lonely" => 30,      
            "very_sad" => 20,    
            "exhausted" => 20,   
            "angry" => 30,       
            "very_angry" => 10   
        ];

        
        $diaries = MoodDiary::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get(['created_at', 'mood']);

     
        $data = [
            'dates' => $diaries->pluck('created_at')->map(fn($date) => $date->format('Y-m-d'))->toArray(),
            'moods' => $diaries->pluck('mood')->map(fn($mood) => $moodMapping[$mood] ?? 0)->toArray(),
        ];

        return response()->json($data); 
    }

}
