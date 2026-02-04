<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLogo from '@/components/AppLogo.vue';
</script>

<template>
    <Head title="{{ $page.props.name }}" />
    <div
        class="grid min-h-dvh place-items-center bg-white px-6 py-10 text-[#1b1b18] dark:bg-[#0a0a0a]"
    >
        <div class="w-full max-w-2xl text-center">
            <AppLogo class="mx-auto mb-6" />
            <h1 class="mb-2 text-3xl font-semibold">
                {{ $page.props.name }}
            </h1>
            <p class="mb-8 text-[#706f6c] dark:text-[#A1A09A]">
                Teste dein Wissen oder reiche neue Fragen ein.
            </p>
            <div
                class="flex flex-col items-center justify-center gap-3 sm:flex-row"
            >
                <Link
                    class="inline-flex items-center justify-center rounded-md bg-black px-5 py-3 text-white dark:bg-white dark:text-black"
                    href="/quiz"
                >
                    Quiz teilnehmen
                </Link>
                <Link
                    class="inline-flex items-center justify-center rounded-md border px-5 py-3 dark:border-[#2a2a29]"
                    href="/questions/submit"
                >
                    Frage einreichen
                </Link>
            </div>
        </div>
    </div>
</template>
