<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/layouts/MainLayout.vue';
</script>

<template>
    <Head title="Impressum" />
    <MainLayout>
        <div class="mx-auto max-w-3xl text-left">
            <h1 class="mb-6 text-3xl font-semibold">Impressum</h1>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold">Angaben gemäß § 5 TMG</h2>
                <p class="text-muted-foreground">
                    <strong>Kay Markschies</strong>
                    <br />
                    24568 Kaltenkirchen
                    <br />
                    Deutschland
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">Kontakt</h2>
                <p class="text-muted-foreground">
                    E-Mail: <strong>kayschima@web.de</strong>
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">
                    Verantwortlich für den Inhalt
                </h2>
                <p class="text-muted-foreground">
                    Verantwortlich i. S. d. § 55 Abs. 2 RStV:
                    <br />
                    <strong>Kay Markschies</strong>
                    <br />
                    24568 Kaltenkirchen
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">Haftung für Inhalte</h2>
                <p class="text-muted-foreground">
                    Als Diensteanbieter sind wir gemäß $ 7 Abs.1 TMG für eigene
                    Inhalte auf diesen Seiten nach den allgemeinen Gesetzen
                    verantwortlich. Nach §§ 8 bis 10 TMG sind wir als
                    Diensteanbieter jedoch nicht verpflichtet, übermittelte oder
                    gespeicherte fremde Informationen zu überwachen oder nach
                    Umständen zu forschen, die auf eine rechtswidrige Tätigkeit
                    hinweisen.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">Haftung für Links</h2>
                <p class="text-muted-foreground">
                    Unser Angebot enthält Links zu externen Websites Dritter,
                    auf deren Inhalte wir keinen Einfluss haben. Deshalb können
                    wir für diese fremden Inhalte auch keine Gewähr übernehmen.
                    Für die Inhalte der verlinkten Seiten ist stets der
                    jeweilige Anbieter oder Betreiber der Seiten verantwortlich.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">Urheberrecht</h2>
                <p class="text-muted-foreground">
                    Die durch die Seitenbetreiber erstellten Inhalte und Werke
                    auf diesen Seiten unterliegen dem deutschen Urheberrecht.
                    Beiträge Dritter sind als solche gekennzeichnet.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">Stand</h2>
                <p class="text-muted-foreground">
                    Stand: <strong>12. Februar 2026</strong>.
                </p>
            </section>
        </div>
    </MainLayout>
</template>
