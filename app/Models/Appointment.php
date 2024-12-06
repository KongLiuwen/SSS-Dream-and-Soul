<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // 可填充的字段
    protected $fillable = [
        'user_id',
        'date',
        'time',
        'status',
    ];

    // 定义与用户的关系
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

