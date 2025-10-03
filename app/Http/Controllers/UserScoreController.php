<?php

namespace App\Http\Controllers;

use App\Models\UserScore;
use Illuminate\Http\Request;

class UserScoreController extends Controller
{
    // GET /api/user-scores
    public function index()
    {
        return response()->json(UserScore::with(['user', 'quiz'])->get());
    }

    // POST /api/user-scores
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer',
            'correct_answers' => 'required|integer',
            'wrong_answers' => 'required|integer',
        ]);

        $userScore = UserScore::create($request->all());
        return response()->json($userScore, 201);
    }

    // GET /api/user-scores/{id}
    public function show($id)
    {
        $userScore = UserScore::with(['user', 'quiz'])->findOrFail($id);
        return response()->json($userScore);
    }

    // PUT /api/user-scores/{id}
    public function update(Request $request, $id)
    {
        $userScore = UserScore::findOrFail($id);

        $request->validate([
            'score' => 'integer',
            'correct_answers' => 'integer',
            'wrong_answers' => 'integer',
        ]);

        $userScore->update($request->all());
        return response()->json($userScore);
    }

    // DELETE /api/user-scores/{id}
    public function destroy($id)
    {
        UserScore::findOrFail($id)->delete();
        return response()->json(['message' => 'User score deleted successfully']);
    }
}
