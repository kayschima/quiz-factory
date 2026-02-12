<script lang="ts" setup>
defineProps<{ countdown: number }>();
</script>

<template>
    <div class="text-center">
        <div
            class="mb-4 text-sm tracking-widest text-muted-foreground uppercase"
        >
            Quiz startet in
        </div>
        <div class="animate-pulse text-8xl font-bold">{{ countdown }}</div>
    </div>
</template>
