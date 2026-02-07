<script lang="ts" setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { Pencil, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';
import QuestionController from '@/actions/App/Http/Controllers/QuestionController';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import MainLayout from '@/layouts/MainLayout.vue';

interface Category {
    id: number;
    name: string;
}

interface Question {
    id: number;
    text: string;
    category: Category;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedQuestions {
    data: Question[];
    links: PaginationLink[];
    current_page: number;
    last_page: number;
    total: number;
}

const props = defineProps<{
    questions: PaginatedQuestions;
    categories: Category[];
    filters: {
        category: string | null;
    };
}>();

const filterByCategory = (value: string) => {
    router.get(
        '/questions',
        { category: value === 'all' ? null : value },
        { preserveState: true, preserveScroll: true },
    );
};

const questionToDelete = ref<Question | null>(null);
const deleteForm = useForm({});

const confirmDelete = (question: Question) => {
    questionToDelete.value = question;
};

const deleteQuestion = () => {
    if (questionToDelete.value) {
        deleteForm.delete(`/questions/${questionToDelete.value.id}`, {
            onSuccess: () => {
                questionToDelete.value = null;
            },
        });
    }
};
</script>

<template>
    <Head title="Fragenübersicht" />

    <MainLayout>
        <div class="container mx-auto px-4 py-10">
            <div class="flex flex-col gap-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight">
                            Zugelassene Fragen
                        </h1>
                        <p class="text-muted-foreground">
                            Hier sind alle bereits geprüften und zugelassenen
                            Fragen aufgelistet.
                        </p>
                    </div>
                    <Button as-child variant="outline">
                        <Link :href="QuestionController.create()">Zurück</Link>
                    </Button>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-full max-w-xs">
                        <Select
                            :model-value="props.filters.category || 'all'"
                            @update:model-value="filterByCategory"
                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Kategorie filtern" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="all"
                                    >Alle Kategorien</SelectItem
                                >
                                <SelectItem
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.id.toString()"
                                >
                                    {{ category.name }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                </div>

                <div class="rounded-md border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[100px]">ID</TableHead>
                                <TableHead class="min-w-[200px]"
                                    >Frage</TableHead
                                >
                                <TableHead>Kategorie</TableHead>
                                <TableHead class="text-right"
                                    >Aktionen</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="question in questions.data"
                                :key="question.id"
                            >
                                <TableCell class="font-medium"
                                    >#{{ question.id }}</TableCell
                                >
                                <TableCell
                                    class="wrap-break-word whitespace-normal"
                                >
                                    {{ question.text }}
                                </TableCell>
                                <TableCell>{{
                                    question.category.name
                                }}</TableCell>
                                <TableCell class="text-right">
                                    <div class="flex justify-end gap-2">
                                        <Button
                                            as-child
                                            size="icon"
                                            variant="outline"
                                        >
                                            <Link
                                                :href="`/questions/${question.id}/edit`"
                                                title="Bearbeiten"
                                            >
                                                <Pencil class="h-4 w-4" />
                                                <span class="sr-only"
                                                    >Bearbeiten</span
                                                >
                                            </Link>
                                        </Button>
                                        <Button
                                            size="icon"
                                            title="Löschen"
                                            variant="destructive"
                                            @click="confirmDelete(question)"
                                        >
                                            <Trash2 class="h-4 w-4" />
                                            <span class="sr-only">Löschen</span>
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="questions.data.length === 0">
                                <TableCell class="h-24 text-center" colspan="4">
                                    Keine Fragen gefunden.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>

                <div
                    v-if="questions.links.length > 3"
                    class="flex justify-center"
                >
                    <nav class="flex items-center gap-1">
                        <template
                            v-for="(link, key) in questions.links"
                            :key="key"
                        >
                            <div
                                v-if="link.url === null"
                                class="rounded-md border border-border px-4 py-2 text-sm text-muted-foreground"
                                v-html="link.label"
                            />
                            <Link
                                v-else
                                :class="[
                                    'rounded-md border border-border px-4 py-2 text-sm transition-colors hover:bg-accent',
                                    link.active
                                        ? 'bg-primary text-primary-foreground hover:bg-primary/90'
                                        : 'bg-background',
                                ]"
                                :href="link.url"
                            >
                                <span v-html="link.label" />
                            </Link>
                        </template>
                    </nav>
                </div>
            </div>
        </div>

        <Dialog
            :open="!!questionToDelete"
            @update:open="(val: boolean) => !val && (questionToDelete = null)"
        >
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Frage löschen?</DialogTitle>
                    <DialogDescription>
                        Bist du sicher, dass du diese Frage unwiderruflich
                        löschen möchtest?
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="questionToDelete = null">
                        Abbrechen
                    </Button>
                    <Button
                        :disabled="deleteForm.processing"
                        variant="destructive"
                        @click="deleteQuestion"
                    >
                        Löschen
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </MainLayout>
</template>
