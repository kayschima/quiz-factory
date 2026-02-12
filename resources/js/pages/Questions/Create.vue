<script lang="ts" setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import MainLayout from '@/layouts/MainLayout.vue';

const props = defineProps<{
    categories: Array<{ id: number; name: string }>;
    difficulties: Array<{ id: number; name: string }>;
    question?: {
        id: number;
        text: string;
        category_id: number;
        difficulty_id: number;
        approved: boolean;
        answers: Array<{ id?: number; text: string; is_correct: boolean }>;
    };
}>();

const form = useForm({
    text: props.question?.text ?? '',
    category_id: props.question?.category_id ?? '',
    difficulty_id: props.question?.difficulty_id ?? '',
    approved: props.question?.approved ?? false,
    answers: props.question?.answers.map((a) => ({
        id: a.id,
        text: a.text,
        is_correct: !!a.is_correct,
    })) ?? [
        { text: '', is_correct: false },
        { text: '', is_correct: false },
        { text: '', is_correct: false },
        { text: '', is_correct: false },
    ],
});

const submit = () => {
    if (props.question) {
        form.put(`/questions/${props.question.id}`);
    } else {
        form.post('/questions');
    }
};

const page = usePage();
const permissions = (page.props.auth?.permissions as string[]) ?? [];
</script>

<template>
    <Head :title="question ? 'Frage bearbeiten' : 'Frage einreichen'" />
    <MainLayout>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">
                {{
                    question
                        ? 'Quizfrage bearbeiten'
                        : 'Neue Quizfrage einreichen'
                }}
            </h1>
            <Link class="text-sm underline" href="/">Zurück</Link>
        </div>

        <form class="space-y-4" @submit.prevent="submit">
            <div>
                <label class="mb-1 block text-sm">Fragetext</label>
                <input
                    v-model="form.text"
                    :class="{ 'border-destructive': form.errors.text }"
                    class="w-full rounded border border-border bg-background px-3 py-2"
                    maxlength="255"
                    required
                    type="text"
                />
                <div
                    v-if="form.errors.text"
                    class="mt-1 text-xs text-destructive"
                >
                    {{ form.errors.text }}
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm">Kategorie</label>
                    <select
                        v-model="form.category_id"
                        :class="{
                            'border-destructive': form.errors.category_id,
                        }"
                        class="w-full rounded border border-border bg-background px-3 py-2"
                        required
                    >
                        <option value="">Bitte wählen</option>
                        <option
                            v-for="cat in categories"
                            :key="cat.id"
                            :value="cat.id"
                        >
                            {{ cat.name }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.category_id"
                        class="mt-1 text-xs text-destructive"
                    >
                        {{ form.errors.category_id }}
                    </div>
                </div>
                <div>
                    <label class="mb-1 block text-sm">Schwierigkeit</label>
                    <select
                        v-model="form.difficulty_id"
                        :class="{
                            'border-destructive': form.errors.difficulty_id,
                        }"
                        class="w-full rounded border border-border bg-background px-3 py-2"
                        required
                    >
                        <option value="">Bitte wählen</option>
                        <option
                            v-for="diff in difficulties"
                            :key="diff.id"
                            :value="diff.id"
                        >
                            {{ diff.name }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.difficulty_id"
                        class="mt-1 text-xs text-destructive"
                    >
                        {{ form.errors.difficulty_id }}
                    </div>
                </div>
            </div>

            <div
                v-if="
                    $page.props.auth?.user &&
                    permissions.includes('edit questions')
                "
            >
                <label class="flex items-center gap-2 text-sm">
                    <input v-model="form.approved" type="checkbox" />
                    Frage freigeben (Approved)
                </label>
            </div>

            <fieldset class="space-y-3">
                <legend class="text-sm font-medium">
                    Antworten (mind. 1, max. 3 richtig)
                </legend>
                <div
                    v-if="form.errors.answers"
                    class="text-xs text-destructive"
                >
                    {{ form.errors.answers }}
                </div>
                <div
                    v-for="(answer, index) in form.answers"
                    :key="index"
                    class="flex flex-col gap-1"
                >
                    <div class="flex items-center gap-3">
                        <input
                            v-model="answer.text"
                            :class="{
                                'border-destructive':
                                    form.errors[`answers.${index}.text`],
                            }"
                            :placeholder="`Antwort ${index + 1}`"
                            class="flex-1 rounded border border-border bg-background px-3 py-2"
                            required
                            type="text"
                        />
                        <label
                            class="flex items-center gap-2 text-sm whitespace-nowrap"
                        >
                            <input
                                v-model="answer.is_correct"
                                type="checkbox"
                            />
                            Richtig
                        </label>
                    </div>
                    <div
                        v-if="form.errors[`answers.${index}.text`]"
                        class="text-xs text-destructive"
                    >
                        {{ form.errors[`answers.${index}.text`] }}
                    </div>
                </div>
            </fieldset>

            <div class="flex gap-3 pt-2">
                <button
                    :disabled="form.processing"
                    class="rounded bg-primary px-4 py-2 text-primary-foreground disabled:opacity-50"
                    type="submit"
                >
                    Speichern
                </button>
                <Link class="rounded border border-border px-4 py-2" href="/"
                    >Abbrechen</Link
                >
                <Link
                    v-if="!question"
                    class="inline-flex items-center justify-center rounded-md border border-border px-5 py-3"
                    href="/questions"
                >
                    Alle eingereichten Fragen
                </Link>
            </div>
        </form>
    </MainLayout>
</template>
