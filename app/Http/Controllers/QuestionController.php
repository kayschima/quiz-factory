<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new question.
     */
    public function create(): Response
    {
        return Inertia::render('Questions/Create', [
            'categories' => Category::all(),
            'difficulties' => Difficulty::all(),
        ]);
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $question = Question::create([
                'text' => $request->text,
                'category_id' => $request->category_id,
                'difficulty_id' => $request->difficulty_id,
                'approved' => false, // Default from specs
            ]);

            foreach ($request->answers as $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'text' => $answerData['text'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        });

        return redirect()->route('home')->with('success', 'Vielen Dank! Deine Frage wurde eingereicht und wird nun geprüft.');
    }
}
