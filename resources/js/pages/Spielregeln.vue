<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import MainLayout from '@/layouts/MainLayout.vue';
</script>

<template>
    <Head title="Spielregeln" />
    <MainLayout>
        <div class="mx-auto max-w-3xl text-left">
            <h1 class="mb-6 text-3xl font-semibold">Spielregeln</h1>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold">1. Ziel des Spiels</h2>
                <p class="text-muted-foreground">
                    Teste dein Wissen rund um den FC St. Pauli! Beantworte so
                    viele Fragen wie möglich richtig und finde heraus, wie gut
                    du dich mit deinem Verein auskennst.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">2. Quiz konfigurieren</h2>
                <p class="text-muted-foreground">
                    Bevor das Quiz startet, kannst du eine
                    <strong>Schwierigkeit</strong> und eine
                    <strong>Kategorie</strong> auswählen – oder einfach „egal"
                    lassen, um Fragen aus allen Bereichen zu erhalten.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">3. Fragen beantworten</h2>
                <p class="text-muted-foreground">
                    Jede Frage bietet dir mehrere Antwortmöglichkeiten. Wähle
                    eine oder mehrere Antworten aus, die du für richtig hältst,
                    und klicke auf
                    <strong>„Weiter"</strong>, um zur nächsten Frage zu
                    gelangen. Bei der letzten Frage klickst du auf
                    <strong>„Auswerten"</strong>.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">4. Auswertung</h2>
                <p class="text-muted-foreground">
                    Nach der letzten Frage erhältst du eine Übersicht mit deinem
                    Ergebnis. Du siehst, wie viele Fragen du richtig beantwortet
                    hast, wie lange du gebraucht hast und welche Antworten
                    korrekt waren.
                </p>
                <ul class="list-disc space-y-2 pl-5 text-muted-foreground">
                    <li>
                        <span class="text-green-600 dark:text-green-400"
                            >Grün ✓</span
                        >
                        – Deine Antwort war richtig.
                    </li>
                    <li>
                        <span class="text-destructive">Rot ✗</span> – Deine
                        Antwort war falsch.
                    </li>
                    <li>
                        <span class="text-yellow-600 dark:text-yellow-400"
                            >Gelb !</span
                        >
                        – Die richtige Antwort, die du nicht ausgewählt hast.
                    </li>
                </ul>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">5. Fragen einreichen</h2>
                <p class="text-muted-foreground">
                    Du hast eigene Quizfragen? Registriere dich und reiche neue
                    Fragen ein, um das Quiz für alle Fans noch besser zu machen!
                </p>
            </section>

            <div class="mt-10 text-center">
                <Button as-child>
                    <Link href="/quiz">Jetzt Quiz starten</Link>
                </Button>
            </div>
        </div>
    </MainLayout>
</template>
