<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'difficulty_id' => ['required', 'exists:difficulties,id'],
            'answers' => ['required', 'array', 'size:4'],
            'answers.*.id' => ['nullable', 'exists:answers,id'],
            'answers.*.text' => ['required', 'string'],
            'answers.*.is_correct' => ['required', 'boolean'],
            'approved' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $correctAnswersCount = collect($this->input('answers'))->where('is_correct', true)->count();

            if ($correctAnswersCount < 1) {
                $validator->errors()->add('answers', 'Mindestens eine Antwort muss als richtig markiert sein.');
            }

            if ($correctAnswersCount > 3) {
                $validator->errors()->add('answers', 'Höchstens drei Antworten dürfen als richtig markiert sein.');
            }
        });
    }
}
