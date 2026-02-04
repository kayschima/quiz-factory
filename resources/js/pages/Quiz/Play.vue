<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

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
const gameState = ref<'loading' | 'countdown' | 'playing' | 'finished'>(
    'loading',
);
const countdown = ref(5);
const score = ref(0);
const startTime = ref<number | null>(null);
const elapsedTime = ref<number | null>(null);

onMounted(async () => {
    const params = new URLSearchParams(window.location.search);
    try {
        const difficultyId = params.get('difficulty_id') || 'any';
        const categoryId = params.get('category_id') || 'any';

        const response = await fetch(
            `/api/quiz-questions?difficulty_id=${difficultyId}&category_id=${categoryId}`,
        );
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
            startTime.value = Date.now();
            gameState.value = 'playing';
        }
    }, 1000);
};

const currentQuestion = computed(
    () => questions.value[currentQuestionIndex.value],
);

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
    if (startTime.value) {
        elapsedTime.value = Date.now() - startTime.value;
    }
    calculateScore();
    gameState.value = 'finished';
};

const calculateScore = () => {
    let correctCount = 0;
    questions.value.forEach((q, idx) => {
        const selected = selectedAnswers.value[idx] || [];
        const correctIds = q.answers
            .filter((a) => a.is_correct)
            .map((a) => a.id);

        const isCorrect =
            selected.length === correctIds.length &&
            selected.every((id) => correctIds.includes(id));

        if (isCorrect) {
            correctCount++;
        }
    });
    score.value = correctCount;
};

const isAnswerSelected = (answerId: number, questionIndex?: number) => {
    const qIdx =
        questionIndex !== undefined
            ? questionIndex
            : currentQuestionIndex.value;
    return selectedAnswers.value[qIdx]?.includes(answerId);
};

const formatTime = (ms: number | null) => {
    if (ms === null) {
        return '';
    }

    const totalSeconds = ms / 1000;
    const mins = Math.floor(totalSeconds / 60);
    const secs = Math.floor(totalSeconds % 60);
    const hundredths = Math.floor((ms % 1000) / 10);

    const hundredthsStr = hundredths.toString().padStart(2, '0');

    if (totalSeconds < 60) {
        return `${secs},${hundredthsStr} Sekunden`;
    }

    return `${mins}:${secs.toString().padStart(2, '0')},${hundredthsStr} Minuten`;
};
</script>

<template>
    <Head title="Quiz" />
    <div
        class="flex min-h-screen items-center justify-center bg-white p-6 text-[#1b1b18] dark:bg-[#0a0a0a] dark:text-[#EDEDEC]"
    >
        <!-- Loading -->
        <div v-if="gameState === 'loading'" class="text-xl font-medium">
            Lade Fragen...
        </div>

        <!-- Countdown -->
        <div v-if="gameState === 'countdown'" class="text-center">
            <div
                class="mb-4 text-sm tracking-widest text-[#706f6c] uppercase dark:text-[#A1A09A]"
            >
                Quiz startet in
            </div>
            <div class="animate-pulse text-8xl font-bold">{{ countdown }}</div>
        </div>

        <!-- Playing -->
        <div v-if="gameState === 'playing'" class="w-full max-w-2xl space-y-8">
            <div class="flex items-end justify-between">
                <div class="space-y-1">
                    <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        Frage {{ currentQuestionIndex + 1 }} von
                        {{ questions.length }}
                    </div>
                    <h2 class="text-2xl leading-tight font-semibold">
                        {{ currentQuestion.text }}
                    </h2>
                </div>
            </div>

            <div class="grid gap-3">
                <button
                    v-for="answer in currentQuestion.answers"
                    :key="answer.id"
                    :class="[
                        isAnswerSelected(answer.id)
                            ? 'border-black bg-black text-white dark:border-white dark:bg-white dark:text-black'
                            : 'border-[#e3e3e0] bg-white hover:border-[#1b1b18] dark:border-[#3E3E3A] dark:bg-[#161615] dark:hover:border-[#EDEDEC]',
                    ]"
                    class="w-full rounded-lg border p-4 text-left transition-all"
                    @click="toggleAnswer(answer.id)"
                >
                    {{ answer.text }}
                </button>
            </div>

            <div class="flex items-center justify-between pt-4">
                <button
                    class="rounded-md bg-black px-6 py-2 font-medium text-white dark:bg-white dark:text-black"
                    @click="finishQuiz"
                >
                    Abbrechen
                </button>
                <button
                    class="rounded-md bg-black px-6 py-2 font-medium text-white dark:bg-white dark:text-black"
                    @click="nextQuestion"
                >
                    {{
                        currentQuestionIndex === questions.length - 1
                            ? 'Auswerten'
                            : 'Weiter'
                    }}
                </button>
            </div>
        </div>

        <!-- Finished -->
        <div
            v-if="gameState === 'finished'"
            class="w-full max-w-3xl space-y-8 py-10"
        >
            <div class="space-y-2 text-center">
                <h1 class="text-4xl font-bold">Quiz beendet!</h1>
                <p class="text-xl text-[#706f6c] dark:text-[#A1A09A]">
                    Du hast
                    <span
                        class="font-bold text-[#1b1b18] dark:text-[#EDEDEC]"
                        >{{ score }}</span
                    >
                    von {{ questions.length }} Fragen richtig beantwortet.
                </p>
                <p
                    v-if="elapsedTime !== null"
                    class="text-sm text-[#706f6c] dark:text-[#A1A09A]"
                >
                    Benötigte Zeit:
                    <span
                        class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]"
                        >{{ formatTime(elapsedTime) }}</span
                    >
                </p>
            </div>

            <div class="space-y-6">
                <div
                    v-for="(q, idx) in questions"
                    :key="q.id"
                    class="space-y-4 rounded-lg border p-6 dark:border-[#2a2a29]"
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
                                    ? 'border-red-500 bg-red-100 text-red-900 dark:bg-red-900/30 dark:text-red-400'
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
                                v-if="
                                    a.is_correct && isAnswerSelected(a.id, idx)
                                "
                                class="ml-1"
                                >✓</span
                            >
                            <span
                                v-if="
                                    !a.is_correct && isAnswerSelected(a.id, idx)
                                "
                                class="ml-1"
                                >✗</span
                            >
                            <span
                                v-if="
                                    a.is_correct && !isAnswerSelected(a.id, idx)
                                "
                                class="ml-1"
                                >!</span
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 text-center">
                <Link
                    class="inline-flex items-center justify-center rounded-md bg-black px-8 py-3 font-medium text-white dark:bg-white dark:text-black"
                    href="/"
                >
                    Quiz beenden
                </Link>
            </div>
        </div>
    </div>
</template>
