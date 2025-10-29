<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyTaskController extends Controller
{
    public function showProgress(Request $request)
{
    $user = $request->user();
    $today = now()->toDateString();
    $target = 14;

    $userTask = \App\Models\UserDailyTask::firstOrCreate([
        'user_id' => $user->id,
        'date' => $today
    ]);

    return response()->json([
        'progress' => $userTask->progress,
        'target' => $target,
        'is_completed' => $userTask->is_completed,
    ]);
}

}
