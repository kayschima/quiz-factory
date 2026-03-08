<script lang="ts" setup>
import { Link, usePage } from '@inertiajs/vue3';
import { Github, LogIn, LogOut, Menu, UserPlus, X } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import settings from '@/actions/App/Http/Controllers/Settings';
import { Button } from '@/components/ui/button';
import { Toast } from '@/components/ui/toast';
import { login, logout, register } from '@/routes';

const page = usePage();
const user = computed(() => page.props.auth?.user);
const mobileMenuOpen = ref(false);

const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};

const closeMobileMenu = () => {
    mobileMenuOpen.value = false;
};
</script>

<template>
    <div class="flex min-h-dvh flex-col bg-background text-foreground">
        <header
            class="flex w-full items-center justify-between border-b bg-card px-6 py-4"
        >
            <Link class="text-xl font-bold tracking-tight" href="/">
                {{ page.props.name }}
            </Link>

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-4 md:flex">
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

            <!-- Mobile Burger Menu Button -->
            <button
                class="flex items-center justify-center md:hidden"
                @click="toggleMobileMenu"
                aria-label="Menü öffnen"
            >
                <Menu v-if="!mobileMenuOpen" class="h-6 w-6" />
                <X v-else class="h-6 w-6" />
            </button>
        </header>

        <!-- Mobile Menu Overlay -->
        <Transition
            enter-active-class="transition-opacity duration-200"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="mobileMenuOpen"
                class="fixed inset-0 z-40 bg-black/50 md:hidden"
                @click="closeMobileMenu"
            />
        </Transition>

        <!-- Mobile Menu Panel -->
        <Transition
            enter-active-class="transition-transform duration-300"
            enter-from-class="translate-x-full"
            enter-to-class="translate-x-0"
            leave-active-class="transition-transform duration-300"
            leave-from-class="translate-x-0"
            leave-to-class="translate-x-full"
        >
            <nav
                v-if="mobileMenuOpen"
                class="fixed right-0 top-0 z-50 flex h-full w-64 flex-col gap-4 border-l bg-card p-6 shadow-lg md:hidden"
            >
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold">Menü</span>
                    <button
                        @click="closeMobileMenu"
                        aria-label="Menü schließen"
                        class="rounded p-1 hover:bg-secondary"
                    >
                        <X class="h-5 w-5" />
                    </button>
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    <template v-if="user">
                        <Button
                            as-child
                            class="w-full justify-start rounded border"
                            size="sm"
                            variant="ghost"
                        >
                            <Link
                                :href="settings.ProfileController.edit()"
                                as="button"
                                class="flex items-center gap-2"
                                @click="closeMobileMenu"
                            >
                                Angemeldet als {{ user.name }}
                            </Link>
                        </Button>
                        <Button
                            as-child
                            class="w-full justify-start rounded border"
                            size="sm"
                            variant="ghost"
                        >
                            <Link
                                :href="logout.url()"
                                as="button"
                                class="flex items-center gap-2"
                                method="post"
                                @click="closeMobileMenu"
                            >
                                <LogOut class="h-4 w-4" />
                                Abmelden
                            </Link>
                        </Button>
                    </template>
                    <template v-else>
                        <Button
                            as-child
                            class="w-full justify-start"
                            size="sm"
                            variant="ghost"
                        >
                            <Link
                                :href="login.url()"
                                class="flex items-center gap-2"
                                @click="closeMobileMenu"
                            >
                                <LogIn class="h-4 w-4" />
                                Anmelden
                            </Link>
                        </Button>
                        <Button
                            as-child
                            class="w-full justify-start"
                            size="sm"
                            variant="default"
                        >
                            <Link
                                :href="register.url()"
                                class="flex items-center gap-2"
                                @click="closeMobileMenu"
                            >
                                <UserPlus class="h-4 w-4" />
                                Registrieren
                            </Link>
                        </Button>
                    </template>

                    <!-- Separator -->
                    <div class="my-2 border-t border-border"></div>

                    <!-- Footer Links for Mobile -->
                    <Button
                        as-child
                        class="w-full justify-start"
                        size="sm"
                        variant="ghost"
                    >
                        <Link
                            href="/datenschutz"
                            class="flex items-center gap-2"
                            @click="closeMobileMenu"
                        >
                            Datenschutzerklärung
                        </Link>
                    </Button>
                    <Button
                        as-child
                        class="w-full justify-start"
                        size="sm"
                        variant="ghost"
                    >
                        <Link
                            href="/impressum"
                            class="flex items-center gap-2"
                            @click="closeMobileMenu"
                        >
                            Impressum
                        </Link>
                    </Button>
                    <Button
                        as-child
                        class="w-full justify-start"
                        size="sm"
                        variant="ghost"
                    >
                        <a
                            href="https://github.com/kayschima/quiz-factory"
                            rel="noopener noreferrer"
                            target="_blank"
                            class="flex items-center gap-2"
                            @click="closeMobileMenu"
                        >
                            <Github class="h-5 w-5" />
                            GitHub Repository
                        </a>
                    </Button>
                </div>
            </nav>
        </Transition>

        <main class="flex-1 px-6 py-10">
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
                <!-- Desktop-only Footer Links -->
                <div class="hidden items-center gap-4 md:flex">
                    <Link class="hover:text-foreground" href="/datenschutz">
                        Datenschutzerklärung
                    </Link>
                    <Link class="hover:text-foreground" href="/impressum">
                        Impressum
                    </Link>
                    <a
                        class="hover:text-foreground"
                        href="https://github.com/kayschima/quiz-factory"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        <Github class="h-5 w-5" />
                    </a>
                </div>
            </div>
        </footer>
    </div>
    <Toast />
</template>

<style scoped></style>
