<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

class QuizService
{
    /**
     * Get random quiz questions based on filters.
     */
    public function getQuizQuestions(
        ?string $difficultyId = null,
        ?string $categoryId = null,
        int $limit = 10
    ): Collection {
        $questions = Question::query()
            ->where('approved', true)
            ->with('answers')
            ->when($difficultyId && $difficultyId !== 'any',
                fn ($query) => $query->where('difficulty_id', $difficultyId))
            ->when($categoryId && $categoryId !== 'any',
                fn ($query) => $query->where('category_id', $categoryId))
            ->inRandomOrder()
            ->limit($limit)
            ->get();

        return $this->shuffleAnswers($questions);
    }

    /**
     * Shuffle answers for each question.
     */
    private function shuffleAnswers(Collection $questions): Collection
    {
        $questions->each(function ($question) {
            $question->setRelation('answers', $question->answers->shuffle());
        });

        return $questions;
    }
}
