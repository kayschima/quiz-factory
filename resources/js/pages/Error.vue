<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';
import {
    AlertTriangle,
    Construction,
    FileQuestion,
    Lock,
    Server,
    ShieldAlert,
} from 'lucide-vue-next';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import MainLayout from '@/layouts/MainLayout.vue';

const props = defineProps<{
    status: number;
}>();

const title = computed(() => {
    return (
        {
            401: '401: Nicht autorisiert',
            403: '403: Zugriff verweigert',
            404: '404: Seite nicht gefunden',
            419: '419: Seite abgelaufen',
            421: '421: Fehlgeleitete Anfrage',
            429: '429: Zu viele Anfragen',
            500: '500: Serverfehler',
            503: '503: Dienst nicht verfügbar',
        }[props.status] || `${props.status}: Ein Fehler ist aufgetreten`
    );
});

const description = computed(() => {
    return (
        {
            401: 'Bitte melde dich an, um auf diese Seite zuzugreifen.',
            403: 'Hoppla! Du hast keine Berechtigung, diese Seite aufzurufen.',
            404: 'Die gesuchte Seite konnte leider nicht gefunden werden.',
            419: 'Die Sitzung ist abgelaufen. Bitte versuche es erneut.',
            421: 'Der Server kann keine Antwort für diese Anfrage produzieren.',
            429: 'Du hast zu viele Anfragen in kurzer Zeit gesendet. Bitte warte einen Moment.',
            500: 'Ups! Etwas ist auf unserem Server schiefgelaufen.',
            503: 'Wir führen gerade Wartungsarbeiten durch. Bitte schau später noch einmal vorbei.',
        }[props.status] || 'Es ist ein unerwarteter Fehler aufgetreten.'
    );
});

const icon = computed(() => {
    switch (props.status) {
        case 401:
        case 403:
            return Lock;
        case 404:
            return FileQuestion;
        case 419:
        case 429:
            return ShieldAlert;
        case 500:
            return AlertTriangle;
        case 503:
            return Construction;
        default:
            return Server;
    }
});
</script>

<template>
    <MainLayout>
        <Head :title="title" />

        <div class="flex flex-col items-center justify-center space-y-6 py-12">
            <div class="rounded-full bg-muted p-6">
                <component :is="icon" class="h-16 w-16 text-muted-foreground" />
            </div>

            <div class="space-y-2">
                <h1 class="text-4xl font-extrabold tracking-tight lg:text-5xl">
                    {{ title }}
                </h1>
                <p class="text-xl text-muted-foreground">
                    {{ description }}
                </p>
            </div>

            <div class="pt-4">
                <Button as-child variant="outline">
                    <Link href="/"> Zurück zur Startseite </Link>
                </Button>
            </div>
        </div>
    </MainLayout>
</template>
