<script lang="ts" setup>
import { Link, usePage } from '@inertiajs/vue3';
import { LogIn, LogOut, UserPlus } from 'lucide-vue-next';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Toast } from '@/components/ui/toast';
import { login, logout, register } from '@/routes';

const page = usePage();
const user = computed(() => page.props.auth?.user);
</script>

<template>
    <header
        class="flex w-full items-center justify-between border-b bg-card px-6 py-4"
    >
        <Link class="text-xl font-bold tracking-tight" href="/">
            St. Pauli Quiz
        </Link>

        <nav class="flex items-center gap-4">
            <template v-if="user">
                <span class="hidden text-sm text-muted-foreground sm:inline">
                    Angemeldet als {{ user.name }}
                </span>
                <Button as-child size="sm" variant="ghost">
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
            </template>
            <template v-else>
                <Button as-child size="sm" variant="ghost">
                    <Link :href="login.url()" class="flex items-center gap-2">
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

    <div
        class="grid min-h-dvh place-items-center bg-background px-6 py-10 text-foreground"
    >
        <div class="w-full max-w-4xl text-center">
            <slot />
        </div>
    </div>
    <Toast />
</template>

<style scoped></style>
