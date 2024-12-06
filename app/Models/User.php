<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Add this line
        'email',
        'password',
        // Add any other attributes you want to allow for mass assignment
    ];

    // 定义与 Appointment 的一对多关系
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
