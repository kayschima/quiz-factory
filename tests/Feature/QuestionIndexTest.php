<?php

use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it can display approved questions', function () {
    $category = Category::create(['name' => 'General']);
    $difficulty = Difficulty::create(['name' => 'Easy', 'level' => 1]);

    $approvedQuestion = Question::create([
        'approved' => true,
        'category_id' => $category->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'UNIQUE_APPROVED_QUESTION_TEXT',
    ]);
    $unapprovedQuestion = Question::create([
        'approved' => false,
        'category_id' => $category->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'UNIQUE_UNAPPROVED_QUESTION_TEXT',
    ]);

    $response = $this->get(route('questions.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('Questions/Index')
        ->where('questions.data', fn ($data) => collect($data)->contains('text', 'UNIQUE_APPROVED_QUESTION_TEXT'))
        ->where('questions.data', fn ($data) => ! collect($data)->contains('text', 'UNIQUE_UNAPPROVED_QUESTION_TEXT'))
    );
});

test('it paginates questions', function () {
    $category = Category::create(['name' => 'General']);
    $difficulty = Difficulty::create(['name' => 'Easy', 'level' => 1]);

    Question::factory()->count(20)->create([
        'approved' => true,
        'category_id' => $category->id,
        'difficulty_id' => $difficulty->id,
    ]);

    $response = $this->get(route('questions.index'));

    $response->assertStatus(200);
    // Check if we have the pagination data structure in Inertia
    $response->assertInertia(fn ($page) => $page
        ->component('Questions/Index')
        ->has('questions.data', 10)
        ->has('questions.links')
        ->where('questions.total', fn ($total) => $total >= 20)
    );
});

test('it can filter questions by category', function () {
    $category1 = Category::create(['name' => 'Category 1']);
    $category2 = Category::create(['name' => 'Category 2']);
    $difficulty = Difficulty::create(['name' => 'Easy', 'level' => 1]);

    Question::create([
        'approved' => true,
        'category_id' => $category1->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'Filter Test Question 1',
    ]);
    Question::create([
        'approved' => true,
        'category_id' => $category2->id,
        'difficulty_id' => $difficulty->id,
        'text' => 'Filter Test Question 2',
    ]);

    $response = $this->get(route('questions.index', ['category' => $category1->id]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('Questions/Index')
        ->where('questions.data', fn ($data) => collect($data)->contains('text', 'Filter Test Question 1'))
        ->where('questions.data', fn ($data) => ! collect($data)->contains('text', 'Filter Test Question 2'))
    );
});
