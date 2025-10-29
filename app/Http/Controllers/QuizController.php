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

    // 🧩 Validasi input
    if (!$quizId || !$correctCount || !$totalQuestions) {
        return response()->json(['message' => 'Data tidak lengkap.'], 400);
    }

    // Ambil quiz yang dikerjakan
    $quiz = Quiz::findOrFail($quizId);

    // Hitung point proporsional berdasarkan jumlah benar
    $maxPoints = $quiz->max_points;
    $pointsEarned = intval(($correctCount / $totalQuestions) * $maxPoints);

    // 🧩 Update poin & rank user
    $user->points += $pointsEarned;
    $user->correct_answers_count += $correctCount;
    $user->updateRank();
    $user->save();

    // Simpan riwayat skor di tabel user_scores
    DB::table('user_scores')->insert([
        'user_id' => $user->id,
        'quiz_id' => $quizId,
        'correct_count' => $correctCount,
        'points_earned' => $pointsEarned,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // 🟢 Tambahkan logika Daily Task
    $today = now()->toDateString();
    $target = 14; // jumlah soal yang harus dijawab per hari
    $reward = 1000; // bonus poin tambahan jika daily task selesai

    $userTask = \App\Models\UserDailyTask::firstOrCreate(
        [
            'user_id' => $user->id,
            'date' => $today,
        ],
        [
            'progress' => 0,
            'is_completed' => false,
        ]
    );

    // Naikkan progress berdasarkan jumlah soal yang baru dijawab
    if (!$userTask->is_completed) {
        $userTask->progress += $totalQuestions; // kamu bisa ubah ke $correctCount kalau ingin hanya jawaban benar yang dihitung

        // Jika progress sudah mencapai target
        if ($userTask->progress >= $target) {
            $userTask->is_completed = true;

            // Beri bonus poin sekali saja
            $user->points += $reward;
            $user->save();
        }

        $userTask->save();
    }

    return response()->json([
        'message' => 'Quiz selesai!',
        'points_earned' => $pointsEarned,
        'total_points' => $user->points,
        'rank' => $user->rank,
        'quiz_max_points' => $maxPoints,
        'daily_task' => [
            'progress' => $userTask->progress,
            'target' => $target,
            'is_completed' => $userTask->is_completed,
        ],
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
