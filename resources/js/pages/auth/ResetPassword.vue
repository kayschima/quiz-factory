<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { update } from '@/routes/password';

const props = defineProps<{
    token: string;
    email: string;
}>();

const inputEmail = ref(props.email);
</script>

<template>
    <AuthLayout
        description="Bitte geben Sie unten Ihr neues Passwort ein"
        title="Passwort zurücksetzen"
    >
        <Head title="Passwort zurücksetzen" />

        <Form
            v-slot="{ errors, processing }"
            :reset-on-success="['password', 'password_confirmation']"
            :transform="(data) => ({ ...data, token, email })"
            v-bind="update.form()"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">E-Mail</Label>
                    <Input
                        id="email"
                        v-model="inputEmail"
                        autocomplete="email"
                        class="mt-1 block w-full"
                        name="email"
                        readonly
                        type="email"
                    />
                    <InputError :message="errors.email" class="mt-2" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Passwort</Label>
                    <Input
                        id="password"
                        autocomplete="new-password"
                        autofocus
                        class="mt-1 block w-full"
                        name="password"
                        placeholder="Passwort"
                        type="password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">
                        Passwort bestätigen
                    </Label>
                    <Input
                        id="password_confirmation"
                        autocomplete="new-password"
                        class="mt-1 block w-full"
                        name="password_confirmation"
                        placeholder="Passwort bestätigen"
                        type="password"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    :disabled="processing"
                    class="mt-4 w-full"
                    data-test="reset-password-button"
                    type="submit"
                >
                    <Spinner v-if="processing" />
                    Passwort zurücksetzen
                </Button>
            </div>
        </Form>
    </AuthLayout>
</template>
