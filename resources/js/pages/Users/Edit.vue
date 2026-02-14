<script lang="ts" setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import UserController from '@/actions/App/Http/Controllers/UserController';
import { Button } from '@/components/ui/button';
import MainLayout from '@/layouts/MainLayout.vue';

interface Role {
    id: number;
    name: string;
}

interface User {
    id: number;
    name: string;
    email: string;
    roles: Role[];
}

const props = defineProps<{
    user: User;
    roles: Role[];
}>();

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    roles: props.user.roles.map((role) => role.name),
});

const toggleRole = (roleName: string, checked: boolean) => {
    if (checked) {
        if (!form.roles.includes(roleName)) {
            form.roles.push(roleName);
        }

        return;
    }

    form.roles = form.roles.filter((role) => role !== roleName);
};

const submit = () => {
    form.put(UserController.update(props.user.id).url);
};
</script>

<template>
    <Head title="Benutzer bearbeiten" />

    <MainLayout>
        <div class="mx-auto max-w-2xl px-4 py-10">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-3xl font-bold tracking-tight">
                    Benutzer bearbeiten
                </h1>
                <Button as-child variant="outline">
                    <Link :href="UserController.index()">Zurück</Link>
                </Button>
            </div>

            <form class="space-y-6" @submit.prevent="submit">
                <div>
                    <label class="mb-1 block text-sm">Name</label>
                    <input
                        v-model="form.name"
                        :class="{ 'border-destructive': form.errors.name }"
                        class="w-full rounded border border-border bg-background px-3 py-2"
                        required
                        type="text"
                    />
                    <div
                        v-if="form.errors.name"
                        class="mt-1 text-xs text-destructive"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-sm">E-Mail</label>
                    <input
                        v-model="form.email"
                        :class="{ 'border-destructive': form.errors.email }"
                        class="w-full rounded border border-border bg-background px-3 py-2"
                        required
                        type="email"
                    />
                    <div
                        v-if="form.errors.email"
                        class="mt-1 text-xs text-destructive"
                    >
                        {{ form.errors.email }}
                    </div>
                </div>

                <fieldset class="space-y-3">
                    <legend class="text-sm font-medium">Rollen</legend>
                    <div
                        v-if="form.errors.roles"
                        class="text-xs text-destructive"
                    >
                        {{ form.errors.roles }}
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <label
                            v-for="role in roles"
                            :key="role.id"
                            class="flex items-center gap-2 text-sm"
                        >
                            <input
                                :checked="form.roles.includes(role.name)"
                                type="checkbox"
                                @change="
                                    toggleRole(
                                        role.name,
                                        ($event.target as HTMLInputElement)
                                            .checked,
                                    )
                                "
                            />
                            {{ role.name }}
                        </label>
                    </div>
                    <div
                        v-if="form.errors['roles.0']"
                        class="text-xs text-destructive"
                    >
                        {{ form.errors['roles.0'] }}
                    </div>
                </fieldset>

                <div class="flex items-center gap-3">
                    <Button :disabled="form.processing" type="submit">
                        Speichern
                    </Button>
                    <Button as-child type="button" variant="outline">
                        <Link :href="UserController.index()">Abbrechen</Link>
                    </Button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>
