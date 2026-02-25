<script lang="ts" setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import QuestionIndexController from '@/actions/App/Http/Controllers/QuestionIndexController';
import UserController from '@/actions/App/Http/Controllers/UserController';
import AppLogo from '@/components/AppLogo.vue';
import { Button } from '@/components/ui/button';
import MainLayout from '@/layouts/MainLayout.vue';

const page = usePage();
const permissions = (page.props.auth?.permissions as string[]) ?? [];
</script>

<template>
    <Head title="Startseite" />
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
            <Button as-child>
                <Link href="/quiz"> Quiz teilnehmen </Link>
            </Button>

            <Button as-child variant="outline">
                <Link href="/spielregeln"> Spielregeln </Link>
            </Button>

            <Button as-child>
                <Link :href="QuestionIndexController.get()">
                    Fragen einsehen & einreichen
                </Link>
            </Button>

            <Button v-if="permissions.includes('delete users')" as-child>
                <Link :href="UserController.index()">Benutzerverwaltung</Link>
            </Button>
        </div>
    </MainLayout>
</template>
