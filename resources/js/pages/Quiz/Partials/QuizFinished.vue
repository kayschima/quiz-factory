<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import type { Question } from './quizTypes';
import { Button } from '@/components/ui/button';

defineProps<{
    questions: Question[];
    score: number;
    elapsedTime: number | null;
    isAnswerSelected: (answerId: number, questionIndex: number) => boolean;
    formatTime: (ms: number | null) => string;
}>();
</script>

<template>
    <div class="w-full max-w-4xl space-y-8 py-10">
        <div class="space-y-2 text-center">
            <h1 class="text-4xl font-bold">Quiz beendet!</h1>
            <p class="text-xl text-muted-foreground">
                Du hast
                <span class="font-bold text-foreground">{{ score }}</span>
                von {{ questions.length }} Fragen richtig beantwortet.
            </p>
            <p
                v-if="elapsedTime !== null"
                class="text-sm text-muted-foreground"
            >
                Benötigte Zeit:
                <span class="font-medium text-foreground">{{
                    formatTime(elapsedTime)
                }}</span>
            </p>
        </div>

        <div class="space-y-6">
            <div
                v-for="(q, idx) in questions"
                :key="q.id"
                class="space-y-4 rounded-lg border border-border p-6"
            >
                <div class="flex gap-3">
                    <span class="font-bold">{{ idx + 1 }}.</span>
                    <h3 class="font-medium">{{ q.text }}</h3>
                </div>
                <div class="grid grid-cols-1 gap-2 pl-7 sm:grid-cols-2">
                    <div
                        v-for="a in q.answers"
                        :key="a.id"
                        :class="[
                            a.is_correct && isAnswerSelected(a.id, idx)
                                ? 'border-green-500 bg-green-100 text-green-900 dark:bg-green-900/30 dark:text-green-400'
                                : '',
                            !a.is_correct && isAnswerSelected(a.id, idx)
                                ? 'border-destructive bg-destructive/10 text-destructive'
                                : '',
                            a.is_correct && !isAnswerSelected(a.id, idx)
                                ? 'border-yellow-500 bg-yellow-100 text-yellow-900 dark:bg-yellow-900/30 dark:text-yellow-400'
                                : '',
                            !a.is_correct && !isAnswerSelected(a.id, idx)
                                ? 'border-transparent opacity-60'
                                : '',
                        ]"
                        class="rounded border p-2 text-sm"
                    >
                        {{ a.text }}
                        <span
                            v-if="a.is_correct && isAnswerSelected(a.id, idx)"
                            class="ml-1"
                            >✓</span
                        >
                        <span
                            v-if="!a.is_correct && isAnswerSelected(a.id, idx)"
                            class="ml-1"
                            >✗</span
                        >
                        <span
                            v-if="a.is_correct && !isAnswerSelected(a.id, idx)"
                            class="ml-1"
                            >!</span
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 text-center">
            <Button as-child>
                <Link href="/"> Quiz beenden </Link>
            </Button>
        </div>
    </div>
</template>
