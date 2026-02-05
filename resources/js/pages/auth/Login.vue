<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthBase
        description="Geben Sie unten Ihre E-Mail-Adresse und Ihr Passwort ein, um sich anzumelden"
        title="In Ihr Konto einloggen"
    >
        <Head title="Einloggen" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-slot="{ errors, processing }"
            :reset-on-success="['password']"
            class="flex flex-col gap-6"
            v-bind="store.form()"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">E-Mail-Adresse</Label>
                    <Input
                        id="email"
                        :tabindex="1"
                        autocomplete="email"
                        autofocus
                        name="email"
                        placeholder="email@example.com"
                        required
                        type="email"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Passwort</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            :tabindex="5"
                            class="text-sm"
                        >
                            Passwort vergessen?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        :tabindex="2"
                        autocomplete="current-password"
                        name="password"
                        placeholder="Passwort"
                        required
                        type="password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label class="flex items-center space-x-3" for="remember">
                        <Checkbox id="remember" :tabindex="3" name="remember" />
                        <span>Angemeldet bleiben</span>
                    </Label>
                </div>

                <Button
                    :disabled="processing"
                    :tabindex="4"
                    class="mt-4 w-full"
                    data-test="login-button"
                    type="submit"
                >
                    <Spinner v-if="processing" />
                    Einloggen
                </Button>
            </div>

            <div
                v-if="canRegister"
                class="text-center text-sm text-muted-foreground"
            >
                Noch kein Konto?
                <TextLink :href="register()" :tabindex="5"
                    >Registrieren</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
