<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuizController extends Controller
{
    /**
     * Show the quiz setup page.
     */
    public function setup(): Response
    {
        return Inertia::render('Quiz/Setup', [
            'categories' => Category::all(),
            'difficulties' => Difficulty::all(),
        ]);
    }

    /**
     * Get questions for the quiz based on filters.
     */
    public function questions(Request $request)
    {
        $query = Question::where('approved', true)->with('answers');

        if ($request->difficulty_id && $request->difficulty_id !== 'any') {
            $query->where('difficulty_id', $request->difficulty_id);
        }

        if ($request->category_id && $request->category_id !== 'any') {
            $query->where('category_id', $request->category_id);
        }

        $questions = $query->inRandomOrder()->limit(10)->get();

        // Shuffle answers for each question
        $questions->each(function ($question) {
            $question->setRelation('answers', $question->answers->shuffle());
        });

        return response()->json($questions);
    }
}
