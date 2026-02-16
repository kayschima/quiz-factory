<script lang="ts" setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import MainLayout from '@/layouts/MainLayout.vue';

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
    <MainLayout>
        <Head title="Quiz starten" />
        <div class="flex items-center justify-center bg-background p-6">
            <div
                class="w-full max-w-xl space-y-6 rounded-lg border border-border p-6"
            >
                <h1 class="text-2xl font-semibold">Quiz konfigurieren</h1>
                <div class="space-y-4">
                    <div>
                        <label class="mb-1 block text-sm">Schwierigkeit</label>
                        <select
                            v-model="difficultyId"
                            class="w-full rounded border border-border bg-background px-3 py-2"
                        >
                            <option value="any">egal</option>
                            <option
                                v-for="diff in difficulties"
                                :key="diff.id"
                                :value="diff.id"
                            >
                                {{ diff.name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm">Kategorie</label>
                        <select
                            v-model="categoryId"
                            class="w-full rounded border border-border bg-background px-3 py-2"
                        >
                            <option value="any">egal</option>
                            <option
                                v-for="cat in categories"
                                :key="cat.id"
                                :value="cat.id"
                            >
                                {{ cat.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3">
                    <Button as-child>
                        <Link @click="startQuiz">Start</Link>
                    </Button>
                    <Button as-child variant="outline">
                        <Link href="/">Abbrechen</Link>
                    </Button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
