<script lang="ts" setup>
import type { HTMLAttributes } from 'vue';
import { MoreHorizontal } from 'lucide-vue-next';
import { cn } from '@/lib/utils';

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <span
    :class="cn('flex size-9 items-center justify-center', props.class)"
    aria-hidden="true"
    data-slot="breadcrumb-ellipsis"
    role="presentation"
  >
    <slot>
      <MoreHorizontal class="size-4" />
    </slot>
    <span class="sr-only">Mehr</span>
  </span>
</template>
