<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodDiary extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mood', 'description'];

    // 关联用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}