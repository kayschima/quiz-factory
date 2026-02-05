<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { logout } from '@/routes';
import { send } from '@/routes/verification';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        description="Bitte bestätigen Sie Ihre E-Mail-Adresse, indem Sie auf den Link klicken, den wir Ihnen gerade geschickt haben."
        title="E-Mail bestätigen"
    >
        <Head title="E-Mail-Bestätigung" />

        <div
            v-if="status === 'verification-link-sent'"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            Ein neuer Bestätigungslink wurde an die E-Mail-Adresse gesendet, die
            Sie bei der Registrierung angegeben haben.
        </div>

        <Form
            v-slot="{ processing }"
            class="space-y-6 text-center"
            v-bind="send.form()"
        >
            <Button :disabled="processing" variant="secondary">
                <Spinner v-if="processing" />
                Bestätigungs-E-Mail erneut senden
            </Button>

            <TextLink
                :href="logout()"
                as="button"
                class="mx-auto block text-sm"
            >
                Ausloggen
            </TextLink>
        </Form>
    </AuthLayout>
</template>
