<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    // GET /api/quizzes
    public function index(Request $request)
{
    $categoryName = $request->query('category'); // ?category=Fashion

    $query = Quiz::with(['category', 'questions.answers'])
        ->select('id', 'title', 'description', 'category_id', 'max_points'); // ✅ tambahkan ini

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

    // Ambil quiz yang dikerjakan
    $quiz = Quiz::findOrFail($quizId);

    // Ambil total poin maksimum dari quiz
    $maxPoints = $quiz->max_points;

    // Hitung point proporsional berdasarkan jumlah benar
    $pointsEarned = intval(($correctCount / $totalQuestions) * $maxPoints);

    // Update data user
    $user->points += $pointsEarned;
    $user->correct_answers_count += $correctCount;
    $user->updateRank();
    $user->save();

    // (Opsional) simpan riwayat di user_scores
    DB::table('user_scores')->insert([
        'user_id' => $user->id,
        'quiz_id' => $quizId,
        'correct_count' => $correctCount,
        'points_earned' => $pointsEarned,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'message' => 'Quiz selesai!',
        'points_earned' => $pointsEarned,
        'total_points' => $user->points,
        'rank' => $user->rank,
        'quiz_max_points' => $maxPoints
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
