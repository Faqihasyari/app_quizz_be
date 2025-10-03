<?php

use App\Http\Controllers\QuizController;
use Illuminate\Routing\Route;

Route::apiResource('quizzes', QuizController::class);
