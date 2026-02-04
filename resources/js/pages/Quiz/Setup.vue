<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
    categories: Array<{ id: number; name: string }>;
    difficulties: Array<{ id: number; name: string }>;
}>();

const difficultyId = ref('any');
const categoryId = ref('any');

const startQuiz = () => {
    router.get('/quiz/play', {
        difficulty_id: difficultyId.value,
        category_id: categoryId.value,
    });
};
</script>

<template>
    <Head title="Quiz starten" />
    <div class="min-h-screen flex items-center justify-center p-6 bg-white dark:bg-[#0a0a0a]">
        <div class="w-full max-w-xl rounded-lg border p-6 space-y-6 dark:border-[#2a2a29]">
            <h1 class="text-2xl font-semibold">Quiz konfigurieren</h1>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm mb-1">Schwierigkeit</label>
                    <select
                        v-model="difficultyId"
                        class="w-full border rounded px-3 py-2 dark:bg-[#161615] dark:border-[#2a2a29]"
                    >
                        <option value="any">egal</option>
                        <option v-for="diff in difficulties" :key="diff.id" :value="diff.id">{{ diff.name }}</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm mb-1">Kategorie</label>
                    <select
                        v-model="categoryId"
                        class="w-full border rounded px-3 py-2 dark:bg-[#161615] dark:border-[#2a2a29]"
                    >
                        <option value="any">egal</option>
                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3">
                <button
                    @click="startQuiz"
                    class="rounded bg-black px-4 py-2 text-white dark:bg-white dark:text-black"
                >
                    Start
                </button>
                <Link href="/" class="rounded border px-4 py-2 dark:border-[#2a2a29]">Abbrechen</Link>
            </div>
        </div>
    </div>
</template>
