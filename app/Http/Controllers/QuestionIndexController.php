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

        $questions = Question::query()
            ->where('approved', true)
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->with('category')
            ->latest()
            ->orderBy('questions.text')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Questions/Index', [
            'questions' => $questions,
            'categories' => Category::all(),
            'filters' => [
                'category' => $categoryId,
            ],
        ]);
    }
}
