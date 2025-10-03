<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class UserAnswerController extends Controller
{
    // GET /api/user-answers
    public function index()
    {
        return response()->json(UserAnswer::with(['user', 'question', 'answer'])->get());
    }

    // POST /api/user-answers
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'question_id' => 'required|exists:questions,id',
            'answer_id' => 'required|exists:answers,id',
        ]);

        // cek apakah jawaban benar
        $answer = Answer::findOrFail($request->answer_id);
        $isCorrect = $answer->is_correct;

        $userAnswer = UserAnswer::create([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
            'answer_id' => $request->answer_id,
            'is_correct' => $isCorrect,
        ]);

        return response()->json($userAnswer, 201);
    }

    // GET /api/user-answers/{id}
    public function show($id)
    {
        $userAnswer = UserAnswer::with(['user', 'question', 'answer'])->findOrFail($id);
        return response()->json($userAnswer);
    }

    // PUT /api/user-answers/{id}
    public function update(Request $request, $id)
    {
        $userAnswer = UserAnswer::findOrFail($id);

        $request->validate([
            'answer_id' => 'required|exists:answers,id',
        ]);

        // cek ulang benar/salah
        $answer = Answer::findOrFail($request->answer_id);
        $isCorrect = $answer->is_correct;

        $userAnswer->update([
            'answer_id' => $request->answer_id,
            'is_correct' => $isCorrect,
        ]);

        return response()->json($userAnswer);
    }

    // DELETE /api/user-answers/{id}
    public function destroy($id)
    {
        UserAnswer::findOrFail($id)->delete();
        return response()->json(['message' => 'User answer deleted successfully']);
    }
}
