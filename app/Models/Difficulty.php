<?php

namespace App\Models;

use Database\Factories\DifficultyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Difficulty extends Model
{
    /** @use HasFactory<DifficultyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
