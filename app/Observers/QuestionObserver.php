<?php

namespace App\Observers;

use App\Models\Question;
use App\Notifications\QuestionCreatedNotification;

class QuestionObserver
{
    public function created(Question $question): void
    {
        $question->notify(new QuestionCreatedNotification);
    }
}
