<script lang="ts" setup>
import { Form, Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import {
    InputOTP,
    InputOTPGroup,
    InputOTPSlot,
} from '@/components/ui/input-otp';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/two-factor/login';
import type { TwoFactorConfigContent } from '@/types';

const authConfigContent = computed<TwoFactorConfigContent>(() => {
    if (showRecoveryInput.value) {
        return {
            title: 'Wiederherstellungscode',
            description:
                'Bitte bestätigen Sie den Zugriff auf Ihr Konto, indem Sie einen Ihrer Notfall-Wiederherstellungscodes eingeben.',
            buttonText: 'mit einem Authentifizierungscode anmelden',
        };
    }

    return {
        title: 'Authentifizierungscode',
        description:
            'Geben Sie den Authentifizierungscode ein, den Sie von Ihrer Authentifizierungsanwendung erhalten haben.',
        buttonText: 'mit einem Wiederherstellungscode anmelden',
    };
});

const showRecoveryInput = ref<boolean>(false);

const toggleRecoveryMode = (clearErrors: () => void): void => {
    showRecoveryInput.value = !showRecoveryInput.value;
    clearErrors();
    code.value = '';
};

const code = ref<string>('');
</script>

<template>
    <AuthLayout
        :description="authConfigContent.description"
        :title="authConfigContent.title"
    >
        <Head title="Zwei-Faktor-Authentifizierung" />

        <div class="space-y-6">
            <template v-if="!showRecoveryInput">
                <Form
                    #default="{ errors, processing, clearErrors }"
                    class="space-y-4"
                    reset-on-error
                    v-bind="store.form()"
                    @error="code = ''"
                >
                    <input :value="code" name="code" type="hidden" />
                    <div
                        class="flex flex-col items-center justify-center space-y-3 text-center"
                    >
                        <div class="flex w-full items-center justify-center">
                            <InputOTP
                                id="otp"
                                v-model="code"
                                :disabled="processing"
                                :maxlength="6"
                                autofocus
                            >
                                <InputOTPGroup>
                                    <InputOTPSlot
                                        v-for="index in 6"
                                        :key="index"
                                        :index="index - 1"
                                    />
                                </InputOTPGroup>
                            </InputOTP>
                        </div>
                        <InputError :message="errors.code" />
                    </div>
                    <Button :disabled="processing" class="w-full" type="submit"
                        >Weiter</Button
                    >
                    <div class="text-center text-sm text-muted-foreground">
                        <span>oder </span>
                        <button
                            class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                            type="button"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.buttonText }}
                        </button>
                    </div>
                </Form>
            </template>

            <template v-else>
                <Form
                    #default="{ errors, processing, clearErrors }"
                    class="space-y-4"
                    reset-on-error
                    v-bind="store.form()"
                >
                    <Input
                        :autofocus="showRecoveryInput"
                        name="recovery_code"
                        placeholder="Wiederherstellungscode eingeben"
                        required
                        type="text"
                    />
                    <InputError :message="errors.recovery_code" />
                    <Button :disabled="processing" class="w-full" type="submit"
                        >Continue</Button
                    >

                    <div class="text-center text-sm text-muted-foreground">
                        <span>or you can </span>
                        <button
                            class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                            type="button"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.buttonText }}
                        </button>
                    </div>
                </Form>
            </template>
        </div>
    </AuthLayout>
</template>
