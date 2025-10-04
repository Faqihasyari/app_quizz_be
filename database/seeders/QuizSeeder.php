<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $quiz = Quiz::create([
            'title' => 'Quiz Matematika',
            'description' => 'Tes logika dasar'
        ]);

        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => '2 + 2 = ?'
        ]);

        Answer::create([
            'question_id' => $question->id,
            'answer_text' => '3',
            'is_correct' => false
        ]);

        Answer::create([
            'question_id' => $question->id,
            'answer_text' => '4',
            'is_correct' => true
        ]);
    }
}
