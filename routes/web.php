<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionIndexController;
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
Route::get('/questions', QuestionIndexController::class)->name('questions.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/questions/submit', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
});

require __DIR__.'/settings.php';
