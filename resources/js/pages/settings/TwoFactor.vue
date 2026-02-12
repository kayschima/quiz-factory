<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import { ShieldBan, ShieldCheck } from 'lucide-vue-next';
import { onUnmounted, ref } from 'vue';
import Heading from '@/components/Heading.vue';
import TwoFactorRecoveryCodes from '@/components/TwoFactorRecoveryCodes.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import MainLayout from '@/layouts/MainLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { disable, enable } from '@/routes/two-factor';

type Props = {
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
};

withDefaults(defineProps<Props>(), {
    requiresConfirmation: false,
    twoFactorEnabled: false,
});

const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref<boolean>(false);

onUnmounted(() => {
    clearTwoFactorAuthData();
});
</script>

<template>
    <MainLayout>
        <Head title="Zwei-Faktor-Authentisierung" />

        <h1 class="sr-only">Zwei-Faktor-Authentisierungseinstellungen</h1>

        <SettingsLayout>
            <div class="space-y-6">
                <Heading
                    description="Verwalten Sie Ihre Zwei-Faktor-Authentisierungseinstellungen"
                    title="Zwei-Faktor-Authentisierung"
                    variant="small"
                />

                <div
                    v-if="!twoFactorEnabled"
                    class="flex flex-col items-start justify-start space-y-4"
                >
                    <Badge variant="destructive">Deaktiviert</Badge>

                    <p class="text-muted-foreground">
                        Wenn Sie die Zwei-Faktor-Authentisierung aktivieren,
                        werden Sie während des Logins nach einer sicheren PIN
                        gefragt. Diese PIN kann über eine TOTP-unterstützte
                        Anwendung auf Ihrem Telefon abgerufen werden.
                    </p>

                    <div>
                        <Button
                            v-if="hasSetupData"
                            @click="showSetupModal = true"
                        >
                            <ShieldCheck />Einrichtung fortsetzen
                        </Button>
                        <Form
                            v-else
                            #default="{ processing }"
                            v-bind="enable.form()"
                            @success="showSetupModal = true"
                        >
                            <Button :disabled="processing" type="submit">
                                <ShieldCheck />2FA aktivieren</Button
                            ></Form
                        >
                    </div>
                </div>

                <div
                    v-else
                    class="flex flex-col items-start justify-start space-y-4"
                >
                    <Badge variant="default">Aktiviert</Badge>

                    <p class="text-muted-foreground">
                        Wenn die Zwei-Faktor-Authentisierung aktiviert ist,
                        werden Sie während des Logins nach einer sicheren,
                        zufälligen PIN gefragt, die Sie über eine
                        TOTP-unterstützte Anwendung auf Ihrem Telefon abrufen
                        können.
                    </p>

                    <TwoFactorRecoveryCodes />

                    <div class="relative inline">
                        <Form #default="{ processing }" v-bind="disable.form()">
                            <Button
                                :disabled="processing"
                                type="submit"
                                variant="destructive"
                            >
                                <ShieldBan />
                                2FA deaktivieren
                            </Button>
                        </Form>
                    </div>
                </div>

                <TwoFactorSetupModal
                    v-model:isOpen="showSetupModal"
                    :requiresConfirmation="requiresConfirmation"
                    :twoFactorEnabled="twoFactorEnabled"
                />
            </div>
        </SettingsLayout>
    </MainLayout>
</template>
