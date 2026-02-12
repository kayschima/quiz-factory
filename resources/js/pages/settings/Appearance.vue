<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import Heading from '@/components/Heading.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
</script>

<template>
    <MainLayout>
        <Head title="Darstellungseinstellungen" />

        <h1 class="sr-only">Darstellungseinstellungen</h1>

        <SettingsLayout>
            <div class="space-y-6">
                <Heading
                    description="Aktualisieren Sie die Darstellungseinstellungen Ihres Kontos"
                    title="Darstellungseinstellungen"
                    variant="small"
                />
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </MainLayout>
</template>
