<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('quiz', [QuizController::class, 'index']);
Route::post('/submit-quiz', [ApiController::class, 'submitQuiz'])->middleware('auth:sanctum');
Route::get('/quiz/{id}/score/{userId}', [QuizController::class, 'getScore']);

//API
Route::get('quiz-categories', [ApiController::class, 'getQuizzesCategories'])->name('quiz-categories');
Route::get('quizzes', [ApiController::class, 'getQuizzes'])->name('quizzes');
Route::get('quizzes/{quiz}', [ApiController::class, 'getQuiz'])->name('getQuiz');
