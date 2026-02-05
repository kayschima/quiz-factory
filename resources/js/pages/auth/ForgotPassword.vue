<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { email } from '@/routes/password';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        description="Geben Sie Ihre E-Mail-Adresse ein, um einen Link zum Zurücksetzen des Passworts zu erhalten"
        title="Passwort vergessen"
    >
        <Head title="Passwort vergessen" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <div class="space-y-6">
            <Form v-slot="{ errors, processing }" v-bind="email.form()">
                <div class="grid gap-2">
                    <Label for="email">E-Mail-Adresse</Label>
                    <Input
                        id="email"
                        autocomplete="off"
                        autofocus
                        name="email"
                        placeholder="email@example.com"
                        type="email"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="my-6 flex items-center justify-start">
                    <Button
                        :disabled="processing"
                        class="w-full"
                        data-test="email-password-reset-link-button"
                    >
                        <Spinner v-if="processing" />
                        Link zum Zurücksetzen senden
                    </Button>
                </div>
            </Form>

            <div class="space-x-1 text-center text-sm text-muted-foreground">
                <span>Oder zurück zum</span>
                <TextLink :href="login()">Login</TextLink>
            </div>
        </div>
    </AuthLayout>
</template>
