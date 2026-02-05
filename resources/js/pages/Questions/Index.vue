<script lang="ts" setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
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

interface Category {
    id: number;
    name: string;
}

interface Question {
    id: number;
    text: string;
    category: Category;
}

const props = defineProps<{
    questions: Question[];
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
</script>

<template>
    <Head title="Fragenübersicht" />

    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-col gap-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">
                        Zugelassene Fragen
                    </h1>
                    <p class="text-muted-foreground">
                        Hier sind alle bereits geprüften und zugelassenen Fragen
                        aufgelistet.
                    </p>
                </div>
                <Button as-child variant="outline">
                    <Link href="/">Zurück zur Startseite</Link>
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
                            <SelectItem value="all">Alle Kategorien</SelectItem>
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
                            <TableHead>Frage</TableHead>
                            <TableHead>Kategorie</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="question in questions"
                            :key="question.id"
                        >
                            <TableCell class="font-medium"
                                >#{{ question.id }}</TableCell
                            >
                            <TableCell>{{ question.text }}</TableCell>
                            <TableCell>{{ question.category.name }}</TableCell>
                        </TableRow>
                        <TableRow v-if="questions.length === 0">
                            <TableCell class="h-24 text-center" colspan="3">
                                Keine Fragen gefunden.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </div>
</template>
