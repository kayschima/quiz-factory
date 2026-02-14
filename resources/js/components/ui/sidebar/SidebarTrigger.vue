<script lang="ts" setup>
import type { HTMLAttributes } from 'vue';
import { PanelLeftClose, PanelLeftOpen } from 'lucide-vue-next';
import { cn } from '@/lib/utils';
import { Button } from '@/components/ui/button';
import { useSidebar } from './utils';

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()

const { isMobile, state, toggleSidebar } = useSidebar()
</script>

<template>
  <Button
    :class="cn('h-7 w-7', props.class)"
    data-sidebar="trigger"
    data-slot="sidebar-trigger"
    size="icon"
    variant="ghost"
    @click="toggleSidebar"
  >
    <PanelLeftOpen v-if="isMobile || state === 'collapsed'" />
    <PanelLeftClose v-else />
    <span class="sr-only">Seitenleiste umschalten</span>
  </Button>
</template>
