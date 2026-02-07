<script lang="ts" setup>
import { Toast } from '@/components/ui/toast';
</script>

<template>
    <div
        class="grid min-h-dvh place-items-center bg-background px-6 py-10 text-foreground"
    >
        <div class="w-full max-w-4xl text-center">
            <slot />
        </div>
    </div>
    <Toast />
</template>

<style scoped></style>
