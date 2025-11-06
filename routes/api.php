<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserAnswerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserScoreController;

Route::apiResource('quizzes', QuizController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('answers', AnswerController::class);
Route::apiResource('user-answers', UserAnswerController::class);
Route::apiResource('user-scores', UserScoreController::class);
Route::get('/users/{id}/profile', [UserController::class, 'profile']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/quizzes/submit', [QuizController::class, 'submitAnswer']);
});

Route::middleware('auth:sanctum')->get('/daily-task', [DailyTaskController::class, 'showToday']);
