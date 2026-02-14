<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Difficulty;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuestionIndexController extends Controller
{
    public function __construct(
        private readonly QuestionService $questionService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $categoryId = $request->query('category');
        $difficultyId = $request->query('difficulty');
        $approved = $request->query('approved');

        $questions = $this->questionService->getPaginatedQuestions(
            categoryId: $categoryId,
            difficultyId: $difficultyId,
            approved: $approved
        );

        return Inertia::render('Questions/Index', [
            'questions' => $questions,
            'categories' => Category::all(),
            'difficulties' => Difficulty::all(),
            'filters' => [
                'category' => $categoryId,
                'difficulty' => $difficultyId,
                'approved' => $approved ?? 'true',
            ],
        ]);
    }
}
