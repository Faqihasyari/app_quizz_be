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

    $quizId = $request->input('quiz_id');
    $correctCount = $request->input('correct_count');
    $totalQuestions = $request->input('total_questions');

    // Hitung presentase benar
    $percentage = $correctCount / $totalQuestions;

    // Tentukan point berdasarkan hasil benar
    if ($correctCount == $totalQuestions) {
        $pointsEarned = 1000;
    } elseif ($correctCount >= 5) {
        $pointsEarned = 500;
    } elseif ($correctCount >= 3) {
        $pointsEarned = 300;
    } else {
        $pointsEarned = 0;
    }

    // Tambahkan ke total poin user
    $user->points += $pointsEarned;
    $user->correct_answers_count += $correctCount;
    $user->updateRank(); // Tetap update rank
    $user->save();

    return response()->json([
        'message' => 'Quiz selesai!',
        'points_earned' => $pointsEarned,
        'total_points' => $user->points,
        'rank' => $user->rank,
        'correct_answers_count' => $user->correct_answers_count
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
