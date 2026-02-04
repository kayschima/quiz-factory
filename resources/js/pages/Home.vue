<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="ST. Pauli Fußball Quiz" />
    <div class="min-h-dvh grid place-items-center bg-white px-6 py-10 text-[#1b1b18] dark:bg-[#0a0a0a]">
        <div class="w-full max-w-2xl text-center">
            <div class="mx-auto mb-8 flex h-24 w-24 items-center justify-center rounded-full border text-2xl font-bold dark:border-[#2a2a29]">
                SP
            </div>
            <h1 class="mb-2 text-3xl font-semibold">St. Pauli Fußball Quiz</h1>
            <p class="mb-8 text-[#706f6c] dark:text-[#A1A09A]">
                Teste dein Wissen oder reiche neue Fragen ein.
            </p>
            <div class="flex flex-col items-center justify-center gap-3 sm:flex-row">
                <Link href="/quiz" class="inline-flex items-center justify-center rounded-md bg-black px-5 py-3 text-white dark:bg-white dark:text-black">
                    Quiz teilnehmen
                </Link>
                <Link href="/questions/submit" class="inline-flex items-center justify-center rounded-md border px-5 py-3 dark:border-[#2a2a29]">
                    Frage einreichen
                </Link>
            </div>
        </div>
    </div>
</template>
