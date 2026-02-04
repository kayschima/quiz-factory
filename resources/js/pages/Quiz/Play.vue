<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';

interface Answer {
    id: number;
    text: string;
    is_correct: boolean;
}

interface Question {
    id: number;
    text: string;
    answers: Answer[];
}

const questions = ref<Question[]>([]);
const currentQuestionIndex = ref(0);
const selectedAnswers = ref<Record<number, number[]>>({}); // questionIndex -> answerIds
const gameState = ref<'loading' | 'countdown' | 'playing' | 'finished'>('loading');
const countdown = ref(5);
const score = ref(0);

onMounted(async () => {
    const params = new URLSearchParams(window.location.search);
    try {
        const difficultyId = params.get('difficulty_id') || 'any';
        const categoryId = params.get('category_id') || 'any';

        const response = await fetch(`/api/quiz-questions?difficulty_id=${difficultyId}&category_id=${categoryId}`);
        questions.value = await response.json();
        startCountdown();
    } catch (error) {
        console.error('Failed to load questions', error);
    }
});

const startCountdown = () => {
    gameState.value = 'countdown';
    const interval = setInterval(() => {
        countdown.value--;
        if (countdown.value === 0) {
            clearInterval(interval);
            gameState.value = 'playing';
        }
    }, 1000);
};

const currentQuestion = computed(() => questions.value[currentQuestionIndex.value]);

const toggleAnswer = (answerId: number) => {
    const qIdx = currentQuestionIndex.value;
    if (!selectedAnswers.value[qIdx]) {
        selectedAnswers.value[qIdx] = [];
    }

    const index = selectedAnswers.value[qIdx].indexOf(answerId);
    if (index === -1) {
        selectedAnswers.value[qIdx].push(answerId);
    } else {
        selectedAnswers.value[qIdx].splice(index, 1);
    }
};

const nextQuestion = () => {
    if (currentQuestionIndex.value < questions.value.length - 1) {
        currentQuestionIndex.value++;
    } else {
        finishQuiz();
    }
};

const finishQuiz = () => {
    calculateScore();
    gameState.value = 'finished';
};

const calculateScore = () => {
    let correctCount = 0;
    questions.value.forEach((q, idx) => {
        const selected = selectedAnswers.value[idx] || [];
        const correctIds = q.answers.filter(a => a.is_correct).map(a => a.id);

        const isCorrect = selected.length === correctIds.length &&
            selected.every(id => correctIds.includes(id));

        if (isCorrect) {
            correctCount++;
        }
    });
    score.value = correctCount;
};

const isAnswerSelected = (answerId: number) => {
    return selectedAnswers.value[currentQuestionIndex.value]?.includes(answerId);
};
</script>

<template>
    <Head title="Quiz" />
    <div class="min-h-screen flex items-center justify-center p-6 bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC]">

        <!-- Loading -->
        <div v-if="gameState === 'loading'" class="text-xl font-medium">
            Lade Fragen...
        </div>

        <!-- Countdown -->
        <div v-if="gameState === 'countdown'" class="text-center">
            <div class="text-sm uppercase tracking-widest text-[#706f6c] dark:text-[#A1A09A] mb-4">Quiz startet in</div>
            <div class="text-8xl font-bold animate-pulse">{{ countdown }}</div>
        </div>

        <!-- Playing -->
        <div v-if="gameState === 'playing'" class="w-full max-w-2xl space-y-8">
            <div class="flex justify-between items-end">
                <div class="space-y-1">
                    <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Frage {{ currentQuestionIndex + 1 }} von {{ questions.length }}</div>
                    <h2 class="text-2xl font-semibold leading-tight">{{ currentQuestion.text }}</h2>
                </div>
                <button @click="finishQuiz" class="text-xs text-red-500 hover:underline">Quiz abbrechen</button>
            </div>

            <div class="grid gap-3">
                <button
                    v-for="answer in currentQuestion.answers"
                    :key="answer.id"
                    @click="toggleAnswer(answer.id)"
                    class="w-full text-left p-4 rounded-lg border transition-all"
                    :class="[
                        isAnswerSelected(answer.id)
                            ? 'bg-black text-white border-black dark:bg-white dark:text-black dark:border-white'
                            : 'bg-white border-[#e3e3e0] hover:border-[#1b1b18] dark:bg-[#161615] dark:border-[#3E3E3A] dark:hover:border-[#EDEDEC]'
                    ]"
                >
                    {{ answer.text }}
                </button>
            </div>

            <div class="flex justify-between items-center pt-4">
                <Link href="/" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:underline">Abbrechen</Link>
                <button
                    @click="nextQuestion"
                    class="rounded-md bg-black px-6 py-2 text-white dark:bg-white dark:text-black font-medium"
                >
                    {{ currentQuestionIndex === questions.length - 1 ? 'Auswerten' : 'Weiter' }}
                </button>
            </div>
        </div>

        <!-- Finished -->
        <div v-if="gameState === 'finished'" class="w-full max-w-3xl space-y-8 py-10">
            <div class="text-center space-y-2">
                <h1 class="text-4xl font-bold">Quiz beendet!</h1>
                <p class="text-xl text-[#706f6c] dark:text-[#A1A09A]">
                    Du hast <span class="text-[#1b1b18] dark:text-[#EDEDEC] font-bold">{{ score }}</span> von {{ questions.length }} Fragen richtig beantwortet.
                </p>
            </div>

            <div class="space-y-6">
                <div v-for="(q, idx) in questions" :key="q.id" class="p-6 rounded-lg border dark:border-[#2a2a29] space-y-4">
                    <div class="flex gap-3">
                        <span class="font-bold">{{ idx + 1 }}.</span>
                        <h3 class="font-medium">{{ q.text }}</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pl-7">
                        <div
                            v-for="a in q.answers"
                            :key="a.id"
                            class="text-sm p-2 rounded border"
                            :class="[
                                a.is_correct ? 'bg-green-100 border-green-500 text-green-900 dark:bg-green-900/30 dark:text-green-400' : 'opacity-60 border-transparent'
                            ]"
                        >
                            {{ a.text }}
                            <span v-if="a.is_correct" class="ml-1">✓</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center pt-6">
                <Link
                    href="/"
                    class="inline-flex items-center justify-center rounded-md bg-black px-8 py-3 text-white dark:bg-white dark:text-black font-medium"
                >
                    Quiz beenden
                </Link>
            </div>
        </div>

    </div>
</template>
