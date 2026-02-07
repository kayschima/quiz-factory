<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class QuestionController extends Controller
{
    /**
     * Store a newly created question in storage.
     */
    public function store(StoreQuestionRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $question = Question::create([
                'text' => $request->text,
                'category_id' => $request->category_id,
                'difficulty_id' => $request->difficulty_id,
                'approved' => $request->approved ?? false,
            ]);

            foreach ($request->answers as $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'text' => $answerData['text'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        });

        return redirect()->back()->with('success', 'Vielen Dank! Deine Frage wurde eingereicht und wird nun geprüft.');
    }

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
     * Show the form for editing the specified question.
     */
    public function edit(Question $question): Response
    {
        return Inertia::render('Questions/Create', [
            'question' => $question->load('answers'),
            'categories' => Category::all(),
            'difficulties' => Difficulty::all(),
        ]);
    }

    /**
     * Update the specified question in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question): RedirectResponse
    {
        DB::transaction(function () use ($request, $question) {
            $question->update([
                'text' => $request->text,
                'category_id' => $request->category_id,
                'difficulty_id' => $request->difficulty_id,
                'approved' => $request->approved ?? false,
            ]);

            foreach ($request->answers as $index => $answerData) {
                $answer = $question->answers->get($index);
                if ($answer) {
                    $answer->update([
                        'text' => $answerData['text'],
                        'is_correct' => $answerData['is_correct'],
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Frage erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return redirect()->back()->with('success', 'Frage erfolgreich gelöscht.');
    }
}
