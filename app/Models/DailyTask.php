<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTask extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'target', 'reward_points'];

    public function userTasks()
    {
        return $this->hasMany(UserDailyTask::class);
    }
}
