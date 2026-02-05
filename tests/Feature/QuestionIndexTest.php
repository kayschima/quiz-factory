<?php

use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Question;

test('it can display approved questions', function () {
    $category = Category::create(['name' => 'General']);
    $difficulty = Difficulty::create(['name' => 'Easy', 'level' => 1]);

    $approvedQuestion = Question::create([
        'approved' => true,
        'category_id' => $category->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'Approved Question',
    ]);
    $unapprovedQuestion = Question::create([
        'approved' => false,
        'category_id' => $category->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'Unapproved Question',
    ]);

    $response = $this->get(route('questions.index'));

    $response->assertStatus(200);
    $response->assertSee('Approved Question');
    $response->assertDontSee('Unapproved Question');
});

test('it can filter questions by category', function () {
    $category1 = Category::create(['name' => 'Category 1']);
    $category2 = Category::create(['name' => 'Category 2']);
    $difficulty = Difficulty::create(['name' => 'Easy', 'level' => 1]);

    Question::create([
        'approved' => true,
        'category_id' => $category1->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'Question in Category 1',
    ]);
    Question::create([
        'approved' => true,
        'category_id' => $category2->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'Question in Category 2',
    ]);

    $response = $this->get(route('questions.index', ['category' => $category1->id]));

    $response->assertStatus(200);
    $response->assertSee('Question in Category 1');
    $response->assertDontSee('Question in Category 2');
});
