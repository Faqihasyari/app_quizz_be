<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserAnswerController;
use App\Http\Controllers\UserScoreController;
use Illuminate\Routing\Route;

Route::apiResource('quizzes', QuizController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('answers', AnswerController::class);
Route::apiResource('user-answers', UserAnswerController::class);
Route::apiResource('user-scores', UserScoreController::class);