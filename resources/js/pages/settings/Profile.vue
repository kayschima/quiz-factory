<script lang="ts" setup>
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import MainLayout from '@/layouts/MainLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { send } from '@/routes/verification';

type Props = {
    mustVerifyEmail: boolean;
    status?: string;
};

defineProps<Props>();

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <MainLayout>
        <Head title="Profileinstellungen" />

        <h1 class="sr-only">Profileinstellungen</h1>

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <Heading
                    description="Aktualisieren Sie Ihren Namen und Ihre E-Mail-Adresse"
                    title="Profilinformationen"
                    variant="small"
                />

                <Form
                    v-slot="{ errors, processing, recentlySuccessful }"
                    class="space-y-6"
                    v-bind="ProfileController.update.form()"
                >
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            :default-value="user.name"
                            autocomplete="name"
                            class="mt-1 block w-full"
                            name="name"
                            placeholder="Vollständiger Name"
                            required
                        />
                        <InputError :message="errors.name" class="mt-2" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">E-Mail-Adresse</Label>
                        <Input
                            id="email"
                            :default-value="user.email"
                            autocomplete="username"
                            class="mt-1 block w-full"
                            name="email"
                            placeholder="E-Mail-Adresse"
                            required
                            type="email"
                        />
                        <InputError :message="errors.email" class="mt-2" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="-mt-4 text-sm text-muted-foreground">
                            Ihre E-Mail-Adresse ist nicht verifiziert.
                            <Link
                                :href="send()"
                                as="button"
                                class="text-foreground underline decoration-border underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current!"
                            >
                                Klicken Sie hier, um die Verifizierungs-E-Mail
                                erneut zu senden.
                            </Link>
                        </p>

                        <div
                            v-if="status === 'verification-link-sent'"
                            class="mt-2 text-sm font-medium text-green-600 dark:text-green-400"
                        >
                            Ein neuer Verifizierungslink wurde an Ihre
                            E-Mail-Adresse gesendet.
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button
                            :disabled="processing"
                            data-test="update-profile-button"
                            >Speichern</Button
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

            <DeleteUser />
        </SettingsLayout>
    </MainLayout>
</template>
