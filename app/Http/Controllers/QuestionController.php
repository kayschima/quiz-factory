<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class QuestionController extends Controller
{
    public function __construct(
        private readonly QuestionService $questionService
    ) {}

    /**
     * Store a newly created question in storage.
     */
    public function store(StoreQuestionRequest $request): RedirectResponse
    {
        $this->questionService->createQuestion($request->validated());

        return redirect()->route('questions.index')
            ->with('success', 'Vielen Dank! Deine Frage wurde eingereicht und wird nun geprüft.');
    }

    /**
     * Show the form for creating a new question.
     */
    public function create(): Response
    {
        abort_if(! auth()->user()->can('create questions'), 403);

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
        abort_if(! auth()->user()->can('edit questions'), 403);

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
        abort_if(! auth()->user()->can('edit questions'), 403);

        $this->questionService->updateQuestion($question, $request->validated());

        return redirect()->route('questions.index')->with('success', 'Frage erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy(Question $question): RedirectResponse
    {
        abort_if(! auth()->user()->can('delete questions'), 403);

        $this->questionService->deleteQuestion($question);

        return redirect()->back()->with('success', 'Frage erfolgreich gelöscht.');
    }
}
