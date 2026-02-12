<script lang="ts" setup>
import { Form } from '@inertiajs/vue3';
import { useTemplateRef } from 'vue';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const passwordInput = useTemplateRef('passwordInput');
</script>

<template>
    <div class="space-y-6">
        <Heading
            description="Löschen Sie Ihr Konto und alle zugehörigen Ressourcen"
            title="Konto löschen"
            variant="small"
        />
        <div
            class="space-y-4 rounded-lg border border-destructive/20 bg-destructive/10 p-4"
        >
            <div class="relative space-y-0.5 text-destructive">
                <p class="font-medium">Warnung</p>
                <p class="text-sm">
                    Bitte gehen Sie vorsichtig vor, dies kann nicht rückgängig
                    gemacht werden.
                </p>
            </div>
            <Dialog>
                <DialogTrigger as-child>
                    <Button data-test="delete-user-button" variant="destructive"
                        >Konto löschen</Button
                    >
                </DialogTrigger>
                <DialogContent>
                    <Form
                        v-slot="{ errors, processing, reset, clearErrors }"
                        :options="{
                            preserveScroll: true,
                        }"
                        class="space-y-6"
                        reset-on-success
                        v-bind="ProfileController.destroy.form()"
                        @error="() => passwordInput?.$el?.focus()"
                    >
                        <DialogHeader class="space-y-3">
                            <DialogTitle
                                >Sind Sie sicher, dass Sie Ihr Konto löschen
                                möchten?</DialogTitle
                            >
                            <DialogDescription>
                                Sobald Ihr Konto gelöscht ist, werden alle
                                zugehörigen Ressourcen und Daten dauerhaft
                                gelöscht. Bitte geben Sie Ihr Passwort ein, um
                                zu bestätigen, dass Sie Ihr Konto dauerhaft
                                löschen möchten.
                            </DialogDescription>
                        </DialogHeader>

                        <div class="grid gap-2">
                            <Label class="sr-only" for="password"
                                >Passwort</Label
                            >
                            <Input
                                id="password"
                                ref="passwordInput"
                                name="password"
                                placeholder="Passwort"
                                type="password"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <DialogFooter class="gap-2">
                            <DialogClose as-child>
                                <Button
                                    variant="secondary"
                                    @click="
                                        () => {
                                            clearErrors();
                                            reset();
                                        }
                                    "
                                >
                                    Abbrechen
                                </Button>
                            </DialogClose>

                            <Button
                                :disabled="processing"
                                data-test="confirm-delete-user-button"
                                type="submit"
                                variant="destructive"
                            >
                                Konto löschen
                            </Button>
                        </DialogFooter>
                    </Form>
                </DialogContent>
            </Dialog>
        </div>
    </div>
</template>
