<?php

namespace App\Models;

use App\Observers\QuestionObserver;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

#[ObservedBy([QuestionObserver::class])]
class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'category_id',
        'difficulty_id',
        'text',
        'approved',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    protected function casts(): array
    {
        return [
            'approved' => 'boolean',
        ];
    }
}
