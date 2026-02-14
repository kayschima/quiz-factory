<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    /**
     * Get paginated questions with filters.
     */
    public function getPaginatedQuestions(
        ?string $categoryId = null,
        ?string $difficultyId = null,
        ?string $approved = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return Question::query()
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->when($difficultyId, fn ($query) => $query->where('difficulty_id', $difficultyId))
            ->when($approved !== null && $approved !== 'all',
                fn ($query) => $query->where('approved', $approved === 'true' || $approved === '1'))
            ->when($approved === null, fn ($query) => $query->where('approved', true))
            ->with(['category', 'difficulty'])
            ->latest()
            ->orderBy('questions.text')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Create a new question with answers.
     */
    public function createQuestion(array $data): Question
    {
        return DB::transaction(function () use ($data) {
            $question = Question::create([
                'text' => $data['text'],
                'category_id' => $data['category_id'],
                'difficulty_id' => $data['difficulty_id'],
                'approved' => $data['approved'] ?? false,
            ]);

            $this->createAnswers($question, $data['answers']);

            return $question;
        });
    }

    /**
     * Create answers for a question.
     */
    private function createAnswers(Question $question, array $answers): void
    {
        foreach ($answers as $answerData) {
            Answer::create([
                'question_id' => $question->id,
                'text' => $answerData['text'],
                'is_correct' => $answerData['is_correct'],
            ]);
        }
    }

    /**
     * Update an existing question with answers.
     */
    public function updateQuestion(Question $question, array $data): Question
    {
        return DB::transaction(function () use ($question, $data) {
            $question->update([
                'text' => $data['text'],
                'category_id' => $data['category_id'],
                'difficulty_id' => $data['difficulty_id'],
                'approved' => $data['approved'] ?? false,
            ]);

            $this->updateAnswers($question, $data['answers']);

            return $question->fresh();
        });
    }

    /**
     * Update answers for a question.
     */
    private function updateAnswers(Question $question, array $answers): void
    {
        foreach ($answers as $index => $answerData) {
            $answer = $question->answers->get($index);
            if ($answer) {
                $answer->update([
                    'text' => $answerData['text'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        }
    }

    /**
     * Delete a question.
     */
    public function deleteQuestion(Question $question): bool
    {
        return $question->delete();
    }
}
