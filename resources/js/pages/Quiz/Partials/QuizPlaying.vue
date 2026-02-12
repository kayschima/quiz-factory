<script lang="ts" setup>
import type { Question } from './quizTypes';

defineProps<{
    question: Question;
    questionIndex: number;
    totalQuestions: number;
    isAnswerSelected: (answerId: number) => boolean;
}>();

defineEmits<{
    (e: 'toggle-answer', answerId: number): void;
    (e: 'next-question'): void;
    (e: 'finish-quiz'): void;
}>();
</script>

<template>
    <div class="w-full max-w-4xl space-y-8">
        <div class="flex items-end justify-between">
            <div class="space-y-1">
                <div class="text-sm text-muted-foreground">
                    Frage {{ questionIndex + 1 }} von {{ totalQuestions }}
                </div>
                <h2 class="text-2xl leading-tight font-semibold">
                    {{ question.text }}
                </h2>
            </div>
        </div>

        <div class="grid gap-3">
            <button
                v-for="answer in question.answers"
                :key="answer.id"
                :class="[
                    isAnswerSelected(answer.id)
                        ? 'border-primary bg-primary text-primary-foreground'
                        : 'border-border bg-background hover:border-foreground/50',
                ]"
                class="w-full rounded-lg border p-4 text-left transition-all"
                @click="$emit('toggle-answer', answer.id)"
            >
                {{ answer.text }}
            </button>
        </div>

        <div class="flex items-center justify-between pt-4">
            <button
                class="rounded-md bg-primary px-6 py-2 font-medium text-primary-foreground"
                @click="$emit('finish-quiz')"
            >
                Abbrechen
            </button>
            <button
                class="rounded-md bg-primary px-6 py-2 font-medium text-primary-foreground"
                @click="$emit('next-question')"
            >
                {{
                    questionIndex === totalQuestions - 1
                        ? 'Auswerten'
                        : 'Weiter'
                }}
            </button>
        </div>
    </div>
</template>
