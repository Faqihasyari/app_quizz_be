<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // GET /api/questions
    public function index()
    {
        return response()->json(Question::with('answers')->get());
    }

    // POST /api/questions
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
        ]);

        $question = Question::create($request->all());

        return response()->json($question, 201);
    }

    // GET /api/questions/{id}
    public function show($id)
    {
        $question = Question::with('answers')->findOrFail($id);
        return response()->json($question);
    }

    // PUT /api/questions/{id}
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());

        return response()->json($question);
    }

    // DELETE /api/questions/{id}
    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
