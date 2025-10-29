<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyTask extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'daily_task_id', 'progress', 'is_completed', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dailyTask()
    {
        return $this->belongsTo(DailyTask::class);
    }
}
