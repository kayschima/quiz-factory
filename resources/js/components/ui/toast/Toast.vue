<script lang="ts" setup>
import { onMounted, ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { CheckCircle2, X, XCircle } from 'lucide-vue-next';
import { cn } from '@/lib/utils';
import { toastVariants } from './index';

const page = usePage();
const visible = ref(false);
const message = ref('');
const variant = ref<'default' | 'destructive' | 'success'>('default');
const timeout = ref<number | null>(null);

const showToast = (msg: string, v: 'default' | 'destructive' | 'success') => {
    if (timeout.value) clearTimeout(timeout.value);

    message.value = msg;
    variant.value = v;
    visible.value = true;

    timeout.value = window.setTimeout(() => {
        visible.value = false;
    }, 5000);
};

watch(() => page.props.flash, (flash: any) => {
    if (flash?.success) {
        showToast(flash.success, 'success');
    } else if (flash?.error) {
        showToast(flash.error, 'destructive');
    }
}, { deep: true });

onMounted(() => {
    const flash = page.props.flash as any;
    if (flash?.success) {
        showToast(flash.success, 'success');
    } else if (flash?.error) {
        showToast(flash.error, 'destructive');
    }
});
</script>

<template>
    <Transition
        enter-active-class="transform transition ease-out duration-300"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="visible"
            :class="cn(toastVariants({ variant }), 'fixed bottom-4 right-4 z-[100] max-w-md')"
        >
            <div class="flex items-start gap-3">
                <CheckCircle2 v-if="variant === 'success'" class="h-5 w-5 mt-0.5" />
                <XCircle v-else-if="variant === 'destructive'" class="h-5 w-5 mt-0.5" />

                <div class="flex-1">
                    <p class="text-sm font-medium">
                        {{ message }}
                    </p>
                </div>

                <button
                    class="rounded-md p-1 opacity-70 transition-opacity hover:opacity-100 focus:outline-none"
                    @click="visible = false"
                >
                    <X class="h-4 w-4" />
                    <span class="sr-only">Schließen</span>
                </button>
            </div>
        </div>
    </Transition>
</template>
