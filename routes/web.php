<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Quiz
Route::get('/quiz', [QuizController::class, 'setup'])->name('quiz.setup');
Route::get('/api/quiz-questions', [QuizController::class, 'questions'])->name('api.quiz-questions');
Route::get('/quiz/play', function () {
    return Inertia::render('Quiz/Play');
})->name('quiz.play');

// Question submission
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/questions/submit', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
});

require __DIR__.'/settings.php';
