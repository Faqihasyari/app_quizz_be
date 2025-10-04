<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserScore;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // GET /api/users/{id}/profile
    public function profile($id)
    {
        $user = User::findOrFail($id);

        $totalScore = UserScore::where('user_id', $user->id)->sum('score');

        return response()->json([
            'user' => $user,
            'total_score' => $totalScore,
        ]);
    }
}
