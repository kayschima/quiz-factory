<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Difficulty;
use App\Services\QuizService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuizController extends Controller
{
    public function __construct(
        private readonly QuizService $quizService
    ) {}

    /**
     * Show the quiz setup page.
     */
    public function setup(): Response
    {
        return Inertia::render('Quiz/Setup', [
            'categories' => Category::query()->orderBy('name')->get(),
            'difficulties' => Difficulty::all(),
        ]);
    }

    /**
     * Get questions for the quiz based on filters.
     */
    public function questions(Request $request): JsonResponse
    {
        $questions = $this->quizService->getQuizQuestions(
            difficultyId: $request->difficulty_id,
            categoryId: $request->category_id
        );

        return response()->json($questions);
    }
}
