<script lang="ts" setup>
import { Form, Head, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import MainLayout from '@/layouts/MainLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';

const page = usePage();

onMounted(() => {
    if (document.querySelector('script[data-turnstile]')) {
        return;
    }

    if (!window.turnstile) {
        const script = document.createElement('script');
        script.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js';
        script.async = true;
        script.defer = true;
        script.dataset.turnstile = 'true';
        document.head.appendChild(script);
    }
});
</script>

<template>
    <MainLayout>
        <Head title="Registrieren" />

        <Form
            v-slot="{ errors, processing }"
            :reset-on-success="['password', 'password_confirmation']"
            class="mx-auto flex w-full flex-col gap-6 md:w-1/2"
            v-bind="store.form()"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Name</Label>
                    <Input
                        id="name"
                        :tabindex="1"
                        autocomplete="name"
                        autofocus
                        name="name"
                        placeholder="Vollständiger Name"
                        required
                        type="text"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">E-Mail-Adresse</Label>
                    <Input
                        id="email"
                        :tabindex="2"
                        autocomplete="email"
                        name="email"
                        placeholder="email@example.com"
                        required
                        type="email"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Passwort</Label>
                    <Input
                        id="password"
                        :tabindex="3"
                        autocomplete="new-password"
                        name="password"
                        placeholder="Passwort"
                        required
                        type="password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation"
                        >Passwort bestätigen</Label
                    >
                    <Input
                        id="password_confirmation"
                        :tabindex="4"
                        autocomplete="new-password"
                        name="password_confirmation"
                        placeholder="Passwort bestätigen"
                        required
                        type="password"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <div class="flex flex-col items-center justify-center gap-2">
                    <div
                        class="cf-turnstile"
                        :data-sitekey="page.props.turnstile_site_key"
                    ></div>
                    <InputError :message="errors['cf-turnstile-response']" />
                </div>

                <Button
                    :disabled="processing"
                    class="mt-2 w-full"
                    data-test="register-user-button"
                    tabindex="5"
                    type="submit"
                >
                    <Spinner v-if="processing" />
                    Konto erstellen
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Bereits registriert?
                <TextLink
                    :href="login()"
                    :tabindex="6"
                    class="underline underline-offset-4"
                    >Einloggen</TextLink
                >
            </div>
        </Form>
    </MainLayout>
</template>
