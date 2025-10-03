<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    // GET /api/answers
    public function index()
    {
        return response()->json(Answer::with('question')->get());
    }

    // POST /api/answers
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_text' => 'required|string',
            'is_correct' => 'required|boolean',
        ]);

        $answer = Answer::create($request->all());

        return response()->json($answer, 201);
    }

    // GET /api/answers/{id}
    public function show($id)
    {
        $answer = Answer::with('question')->findOrFail($id);
        return response()->json($answer);
    }

    // PUT /api/answers/{id}
    public function update(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->update($request->all());

        return response()->json($answer);
    }

    // DELETE /api/answers/{id}
    public function destroy($id)
    {
        Answer::findOrFail($id)->delete();
        return response()->json(['message' => 'Answer deleted successfully']);
    }
}
