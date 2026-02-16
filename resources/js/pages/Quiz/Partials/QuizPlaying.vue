<script lang="ts" setup>
import type { Question } from './quizTypes';
import { Button } from '@/components/ui/button';

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

        <div class="grid gap-3 lg:grid-cols-2">
            <Button
                v-for="answer in question.answers"
                :key="answer.id"
                :variant="isAnswerSelected(answer.id) ? 'default' : 'outline'"
                class="w-full rounded-lg border p-4 text-left text-lg transition-all"
                @click="$emit('toggle-answer', answer.id)"
            >
                {{ answer.text }}
            </Button>
        </div>

        <div class="flex items-center justify-between pt-4">
            <Button variant="outline" @click="$emit('finish-quiz')">
                Abbrechen
            </Button>
            <Button @click="$emit('next-question')">
                {{
                    questionIndex === totalQuestions - 1
                        ? 'Auswerten'
                        : 'Weiter'
                }}
            </Button>
        </div>
    </div>
</template>
