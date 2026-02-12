<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuestionIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $categoryId = $request->query('category');
        $difficultyId = $request->query('difficulty');
        $approved = $request->query('approved');

        $questions = Question::query()
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($difficultyId, function ($query, $difficultyId) {
                return $query->where('difficulty_id', $difficultyId);
            })
            ->when($approved !== null && $approved !== 'all', function ($query) use ($approved) {
                return $query->where('approved', $approved === 'true' || $approved === '1');
            })
            ->when($approved === null, function ($query) {
                return $query->where('approved', true);
            })
            ->with(['category', 'difficulty'])
            ->latest()
            ->orderBy('questions.text')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Questions/Index', [
            'questions' => $questions,
            'categories' => Category::all(),
            'difficulties' => \App\Models\Difficulty::all(),
            'filters' => [
                'category' => $categoryId,
                'difficulty' => $difficultyId,
                'approved' => $approved ?? 'true',
            ],
        ]);
    }
}
