<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    categories: Array<{ id: number; name: string }>;
    difficulties: Array<{ id: number; name: string }>;
}>();

const form = useForm({
    text: '',
    category_id: '',
    difficulty_id: '',
    answers: [
        { text: '', is_correct: false },
        { text: '', is_correct: false },
        { text: '', is_correct: false },
        { text: '', is_correct: false },
    ],
});

const submit = () => {
    form.post('/questions');
};
</script>

<template>
    <Head title="Frage einreichen" />
    <div class="min-h-screen flex items-center justify-center p-6 bg-background">
        <div class="w-full max-w-2xl rounded-lg border p-6 space-y-6 border-border">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Neue Quizfrage einreichen</h1>
                <Link href="/" class="text-sm underline">Zurück</Link>
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm mb-1">Fragetext</label>
                    <input
                        v-model="form.text"
                        type="text"
                        maxlength="255"
                        required
                        class="w-full border rounded px-3 py-2 bg-background border-border"
                        :class="{ 'border-destructive': form.errors.text }"
                    />
                    <div v-if="form.errors.text" class="text-destructive text-xs mt-1">{{ form.errors.text }}</div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm mb-1">Kategorie</label>
                        <select
                            v-model="form.category_id"
                            required
                        class="w-full border rounded px-3 py-2 bg-background border-border"
                            :class="{ 'border-destructive': form.errors.category_id }"
                        >
                            <option value="">Bitte wählen</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>
                        <div v-if="form.errors.category_id" class="text-destructive text-xs mt-1">{{ form.errors.category_id }}</div>
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Schwierigkeit</label>
                        <select
                            v-model="form.difficulty_id"
                            required
                        class="w-full border rounded px-3 py-2 bg-background border-border"
                            :class="{ 'border-destructive': form.errors.difficulty_id }"
                        >
                            <option value="">Bitte wählen</option>
                            <option v-for="diff in difficulties" :key="diff.id" :value="diff.id">{{ diff.name }}</option>
                        </select>
                        <div v-if="form.errors.difficulty_id" class="text-destructive text-xs mt-1">{{ form.errors.difficulty_id }}</div>
                    </div>
                </div>

                <fieldset class="space-y-3">
                    <legend class="text-sm font-medium">Antworten (mind. 1, max. 3 richtig)</legend>
                    <div v-if="form.errors.answers" class="text-destructive text-xs">{{ form.errors.answers }}</div>
                    <div v-for="(answer, index) in form.answers" :key="index" class="flex flex-col gap-1">
                        <div class="flex items-center gap-3">
                            <input
                                v-model="answer.text"
                                type="text"
                                required
                                class="flex-1 border rounded px-3 py-2 bg-background border-border"
                                :placeholder="`Antwort ${index + 1}`"
                                :class="{ 'border-destructive': form.errors[`answers.${index}.text`] }"
                            />
                            <label class="flex items-center gap-2 text-sm whitespace-nowrap">
                                <input v-model="answer.is_correct" type="checkbox" />
                                Richtig
                            </label>
                        </div>
                        <div v-if="form.errors[`answers.${index}.text`]" class="text-destructive text-xs">{{ form.errors[`answers.${index}.text`] }}</div>
                    </div>
                </fieldset>

                <div class="flex gap-3 pt-2">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded bg-primary px-4 py-2 text-primary-foreground disabled:opacity-50"
                    >
                        Speichern
                    </button>
                    <Link href="/" class="rounded border px-4 py-2 border-border">Abbrechen</Link>
                </div>
            </form>
        </div>
    </div>
</template>
