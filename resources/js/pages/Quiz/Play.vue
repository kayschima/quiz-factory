<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import MainLayout from '@/layouts/MainLayout.vue';
import QuizCountdown from '@/pages/Quiz/Partials/QuizCountdown.vue';
import QuizFinished from '@/pages/Quiz/Partials/QuizFinished.vue';
import QuizLoading from '@/pages/Quiz/Partials/QuizLoading.vue';
import QuizPlaying from '@/pages/Quiz/Partials/QuizPlaying.vue';
import type { Question } from '@/pages/Quiz/Partials/quizTypes';

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
    () => questions.value[currentQuestionIndex.value] ?? null,
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
    <MainLayout>
        <!-- Loading -->
        <QuizLoading v-if="gameState === 'loading'" />

        <!-- Countdown -->
        <QuizCountdown v-if="gameState === 'countdown'" :countdown="countdown" />

        <!-- Playing -->
        <QuizPlaying
            v-if="gameState === 'playing' && currentQuestion"
            :question="currentQuestion"
            :question-index="currentQuestionIndex"
            :total-questions="questions.length"
            :is-answer-selected="isAnswerSelected"
            @toggle-answer="toggleAnswer"
            @finish-quiz="finishQuiz"
            @next-question="nextQuestion"
        />

        <!-- Finished -->
        <QuizFinished
            v-if="gameState === 'finished'"
            :questions="questions"
            :score="score"
            :elapsed-time="elapsedTime"
            :is-answer-selected="isAnswerSelected"
            :format-time="formatTime"
        />
    </MainLayout>
</template>

