<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Routing\Route;

Route::apiResource('quizzes', QuizController::class);
Route::apiResource('questions', QuestionController::class);
