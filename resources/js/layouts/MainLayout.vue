<script lang="ts" setup>
import { Link, usePage } from '@inertiajs/vue3';
import { LogIn, LogOut, UserPlus } from 'lucide-vue-next';
import { computed } from 'vue';
import settings from '@/actions/App/Http/Controllers/Settings';
import { Button } from '@/components/ui/button';
import { Toast } from '@/components/ui/toast';
import { login, logout, register } from '@/routes';

const page = usePage();
const user = computed(() => page.props.auth?.user);
</script>

<template>
    <div class="flex min-h-dvh flex-col bg-background text-foreground">
        <header
            class="fixed flex w-full items-center justify-between border-b bg-card px-6 py-4"
        >
            <Link class="text-xl font-bold tracking-tight" href="/">
                {{ page.props.name }}
            </Link>

            <nav class="flex items-center gap-4">
                <template v-if="user">
                    <div
                        class="grid grid-cols-1 items-center gap-1 lg:grid-cols-2"
                    >
                        <Button
                            as-child
                            class="rounded border"
                            size="sm"
                            variant="ghost"
                        >
                            <Link
                                :href="settings.ProfileController.edit()"
                                as="button"
                                class="flex items-center gap-2"
                            >
                                Angemeldet als {{ user.name }}
                            </Link>
                        </Button>
                        <Button
                            as-child
                            class="rounded border"
                            size="sm"
                            variant="ghost"
                        >
                            <Link
                                :href="logout.url()"
                                as="button"
                                class="flex items-center gap-2"
                                method="post"
                            >
                                <LogOut class="h-4 w-4" />
                                Abmelden
                            </Link>
                        </Button>
                    </div>
                </template>
                <template v-else>
                    <Button as-child size="sm" variant="ghost">
                        <Link
                            :href="login.url()"
                            class="flex items-center gap-2"
                        >
                            <LogIn class="h-4 w-4" />
                            Anmelden
                        </Link>
                    </Button>
                    <Button as-child size="sm" variant="default">
                        <Link
                            :href="register.url()"
                            class="flex items-center gap-2"
                        >
                            <UserPlus class="h-4 w-4" />
                            Registrieren
                        </Link>
                    </Button>
                </template>
            </nav>
        </header>

        <main class="mt-12 flex-1 px-6 py-10">
            <div class="mx-auto w-full max-w-4xl text-center">
                <slot />
            </div>
        </main>
        <footer
            class="border-t bg-card px-6 py-4 text-sm text-muted-foreground"
        >
            <div
                class="mx-auto flex w-full max-w-4xl flex-wrap items-center justify-between gap-3"
            >
                <span>© {{ page.props.name }}</span>
                <div class="flex items-center gap-4">
                    <Link class="hover:text-foreground" href="/datenschutz">
                        Datenschutzerklärung
                    </Link>
                    <Link class="hover:text-foreground" href="/impressum">
                        Impressum
                    </Link>
                </div>
            </div>
        </footer>
    </div>
    <Toast />
</template>

<style scoped></style>
