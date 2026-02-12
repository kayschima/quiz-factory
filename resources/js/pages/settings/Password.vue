<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import PasswordController from '@/actions/App/Http/Controllers/Settings/PasswordController';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import MainLayout from '@/layouts/MainLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
</script>

<template>
    <MainLayout>
        <Head title="Passwort-Einstellungen" />

        <h1 class="sr-only">Passwort-Einstellungen</h1>

        <SettingsLayout>
            <div class="space-y-6">
                <Heading
                    description="Stellen Sie sicher, dass Ihr Konto ein langes, zufälliges Passwort verwendet, um sicher zu bleiben"
                    title="Passwort aktualisieren"
                    variant="small"
                />

                <Form
                    v-slot="{ errors, processing, recentlySuccessful }"
                    :options="{
                        preserveScroll: true,
                    }"
                    :reset-on-error="[
                        'password',
                        'password_confirmation',
                        'current_password',
                    ]"
                    class="space-y-6"
                    reset-on-success
                    v-bind="PasswordController.update.form()"
                >
                    <div class="grid gap-2">
                        <Label for="current_password">Aktuelles Passwort</Label>
                        <Input
                            id="current_password"
                            autocomplete="current-password"
                            class="mt-1 block w-full"
                            name="current_password"
                            placeholder="Aktuelles Passwort"
                            type="password"
                        />
                        <InputError :message="errors.current_password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password">Neues Passwort</Label>
                        <Input
                            id="password"
                            autocomplete="new-password"
                            class="mt-1 block w-full"
                            name="password"
                            placeholder="Neues Passwort"
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
                            autocomplete="new-password"
                            class="mt-1 block w-full"
                            name="password_confirmation"
                            placeholder="Passwort bestätigen"
                            type="password"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button
                            :disabled="processing"
                            data-test="update-password-button"
                            >Passwort speichern</Button
                        >

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p
                                v-show="recentlySuccessful"
                                class="text-sm text-muted-foreground"
                            >
                                Gespeichert.
                            </p>
                        </Transition>
                    </div>
                </Form>
            </div>
        </SettingsLayout>
    </MainLayout>
</template>
