<?php

namespace App\Http\Controllers;

use App\Models\MoodDiary;
use Illuminate\Http\Request;

class MoodDiaryController extends Controller
{
    // 显示情绪日记列表
    public function index()
    {
        $diaries = MoodDiary::where('user_id', auth()->id())->latest()->paginate(10);
        return view('mood_diaries.index', compact('diaries'));
    }

    // 显示创建情绪日记的表单
    public function create()
    {
        return view('mood_diaries.create');
    }

    // 保存新的情绪日记
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

    // 显示编辑情绪日记的表单
    public function edit(MoodDiary $moodDiary)
    {
        $this->authorize('update', $moodDiary); // 确保用户只能编辑自己的日记
        return view('mood_diaries.edit', compact('moodDiary'));
    }

    // 更新情绪日记
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

    // 删除情绪日记
    public function destroy(MoodDiary $moodDiary)
    {
        $this->authorize('delete', $moodDiary);
        $moodDiary->delete();
        return redirect()->route('mood-diaries.index')->with('success', 'Emotion diary entry deleted successfully！');
    }

    public function chartData()
    {
        // 定义心情与数值的映射
        $moodMapping = [
            "very_happy" => 100, // 非常开心
            "excited" => 90,     // 兴奋
            "happy" => 80,       // 开心
            "grateful" => 80,    // 感激
            "content" => 70,     // 满足
            "calm" => 60,        // 平静
            "neutral" => 50,     // 中立
            "slightly_sad" => 40,// 有点沮丧
            "anxious" => 40,     // 焦虑
            "sad" => 30,         // 难过
            "lonely" => 30,      // 孤独
            "very_sad" => 20,    // 非常难过
            "exhausted" => 20,   // 疲惫
            "angry" => 30,       // 愤怒
            "very_angry" => 10   // 非常愤怒
        ];

        // 获取当前用户的情绪记录，按日期排序
        $diaries = MoodDiary::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get(['created_at', 'mood']);

        // 准备数据
        $data = [
            'dates' => $diaries->pluck('created_at')->map(fn($date) => $date->format('Y-m-d'))->toArray(),
            'moods' => $diaries->pluck('mood')->map(fn($mood) => $moodMapping[$mood] ?? 0)->toArray(),
        ];

        return response()->json($data); // 返回 JSON 数据
    }

}
