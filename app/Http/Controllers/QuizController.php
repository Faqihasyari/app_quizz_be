<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // GET /api/quizzes
    public function index(Request $request)
    {
        $categoryName = $request->query('category'); // ambil parameter dari URL (?category=Fashion)

        $query = Quiz::with(['category', 'questions.answers']);

        if ($categoryName) {
            // Filter berdasarkan nama kategori
            $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        return $query->get();
    }


    public function submitAnswer(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Misal kamu sudah punya logic menghitung benar/salah
        $isCorrect = $request->input('is_correct'); // true / false

        if ($isCorrect) {
            $user->correct_answers_count = $user->correct_answers_count + 1;
            $user->save();
        }

        // 🔹 Update rank setiap kali user menjawab benar
        $user->updateRank();

        return response()->json([
            'message' => 'Jawaban tersimpan!',
            'rank' => $user->rank,
            'correct_answers_count' => $user->correct_answers_count,
        ]);
    }


    // POST /api/quizzes
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'created_by' => 'required|exists:users,id',
        ]);

        $quiz = Quiz::create($request->all());

        return response()->json($quiz, 201);
    }

    // GET /api/quizzes/{id}
    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return response()->json($quiz);
    }

    // PUT /api/quizzes/{id}
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());

        return response()->json($quiz);
    }

    // DELETE /api/quizzes/{id}
    public function destroy($id)
    {
        Quiz::findOrFail($id)->delete();
        return response()->json(['message' => 'Quiz deleted successfully']);
    }
}
