<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLogo from '@/components/AppLogo.vue';
import MainLayout from '@/layouts/MainLayout.vue';
</script>

<template>
    <Head title="{{ $page.props.name }}" />
    <MainLayout>
        <AppLogo class="mx-auto mb-6" />
        <h1 class="mb-2 text-3xl font-semibold">
            {{ $page.props.name }}
        </h1>
        <p class="mb-8 text-muted-foreground">
            Teste dein Wissen oder reiche neue Fragen ein.
        </p>
        <div
            class="flex flex-col items-center justify-center gap-3 sm:flex-row"
        >
            <Link
                class="inline-flex items-center justify-center rounded-md bg-primary px-5 py-3 text-primary-foreground"
                href="/quiz"
            >
                Quiz teilnehmen
            </Link>
            <Link
                class="inline-flex items-center justify-center rounded-md border border-border px-5 py-3"
                href="/questions/submit"
            >
                Frage einreichen
            </Link>
        </div>
    </MainLayout>
</template>
