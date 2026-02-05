<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/password/confirm';
</script>

<template>
    <AuthLayout
        description="Dies ist ein geschützter Bereich der Anwendung. Bitte bestätigen Sie Ihr Passwort, bevor Sie fortfahren."
        title="Passwort bestätigen"
    >
        <Head title="Passwort bestätigen" />

        <Form
            v-slot="{ errors, processing }"
            reset-on-success
            v-bind="store.form()"
        >
            <div class="space-y-6">
                <div class="grid gap-2">
                    <Label htmlFor="password">Passwort</Label>
                    <Input
                        id="password"
                        autocomplete="current-password"
                        autofocus
                        class="mt-1 block w-full"
                        name="password"
                        required
                        type="password"
                    />

                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center">
                    <Button
                        :disabled="processing"
                        class="w-full"
                        data-test="confirm-password-button"
                    >
                        <Spinner v-if="processing" />
                        Passwort bestätigen
                    </Button>
                </div>
            </div>
        </Form>
    </AuthLayout>
</template>
