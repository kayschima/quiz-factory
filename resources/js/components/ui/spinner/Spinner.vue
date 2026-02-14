<script lang="ts" setup>
import type { HTMLAttributes } from 'vue';
import { Loader2Icon } from 'lucide-vue-next';
import { cn } from '@/lib/utils';

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <Loader2Icon
    :class="cn('size-4 animate-spin', props.class)"
    aria-label="Wird geladen"
    role="status"
  />
</template>
