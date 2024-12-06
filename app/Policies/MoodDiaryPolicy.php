<?php

namespace App\Policies;

use App\Models\MoodDiary;
use App\Models\User;

class MoodDiaryPolicy
{
    /**
     * 检查用户是否可以更新情绪日记
     */
    public function update(User $user, MoodDiary $moodDiary)
    {
        return $user->id === $moodDiary->user_id; // 只有日记的创建者可以更新
    }

    /**
     * 检查用户是否可以删除情绪日记
     */
    public function delete(User $user, MoodDiary $moodDiary)
    {
        return $user->id === $moodDiary->user_id; // 只有日记的创建者可以删除
    }
}
