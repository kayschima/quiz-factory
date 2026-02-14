<script lang="ts" setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Pencil, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';
import UserController from '@/actions/App/Http/Controllers/UserController';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
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

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedUsers {
    data: User[];
    links: PaginationLink[];
}

defineProps<{
    users: PaginatedUsers;
}>();

const userToDelete = ref<User | null>(null);
const deleteForm = useForm({});

const confirmDelete = (user: User) => {
    userToDelete.value = user;
};

const deleteUser = () => {
    if (userToDelete.value) {
        deleteForm.delete(UserController.destroy(userToDelete.value.id).url, {
            onSuccess: () => {
                userToDelete.value = null;
            },
        });
    }
};
</script>

<template>
    <Head title="Benutzerverwaltung" />

    <MainLayout>
        <div class="container mx-auto px-4 py-10">
            <div class="flex flex-col gap-6">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">
                        Benutzerverwaltung
                    </h1>
                    <p class="text-muted-foreground">
                        Übersicht über alle Benutzer und deren Rollen.
                    </p>
                </div>

                <div class="rounded-md border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-20">ID</TableHead>
                                <TableHead>Name</TableHead>
                                <TableHead>E-Mail</TableHead>
                                <TableHead>Rollen</TableHead>
                                <TableHead class="text-right"
                                    >Aktionen</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="user in users.data" :key="user.id">
                                <TableCell class="font-medium"
                                    >#{{ user.id }}</TableCell
                                >
                                <TableCell>{{ user.name }}</TableCell>
                                <TableCell>{{ user.email }}</TableCell>
                                <TableCell>
                                    {{
                                        user.roles.length
                                            ? user.roles
                                                  .map((role) => role.name)
                                                  .join(', ')
                                            : 'Keine Rolle'
                                    }}
                                </TableCell>
                                <TableCell class="text-right">
                                    <div class="flex justify-end gap-2">
                                        <Button
                                            as-child
                                            size="icon"
                                            title="Bearbeiten"
                                            variant="outline"
                                        >
                                            <Link
                                                :href="UserController.edit(user.id)"
                                            >
                                                <Pencil class="h-4 w-4" />
                                                <span class="sr-only"
                                                    >Bearbeiten</span
                                                >
                                            </Link>
                                        </Button>
                                        <Button
                                            size="icon"
                                            title="Löschen"
                                            variant="destructive"
                                            @click="confirmDelete(user)"
                                        >
                                            <Trash2 class="h-4 w-4" />
                                            <span class="sr-only">Löschen</span>
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="users.data.length === 0">
                                <TableCell class="h-24 text-center" colspan="5">
                                    Keine Benutzer gefunden.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>

                <div v-if="users.links.length > 3" class="flex justify-center">
                    <nav class="flex items-center gap-1">
                        <template v-for="(link, key) in users.links" :key="key">
                            <div
                                v-if="link.url === null"
                                class="rounded-md border border-border px-4 py-2 text-sm text-muted-foreground"
                                v-html="link.label"
                            />
                            <Link
                                v-else
                                :class="[
                                    'rounded-md border border-border px-4 py-2 text-sm transition-colors hover:bg-accent',
                                    link.active
                                        ? 'bg-primary text-primary-foreground hover:bg-primary/90'
                                        : 'bg-background',
                                ]"
                                :href="link.url"
                            >
                                <span v-html="link.label" />
                            </Link>
                        </template>
                    </nav>
                </div>
            </div>
        </div>

        <Dialog
            :open="!!userToDelete"
            @update:open="(val: boolean) => !val && (userToDelete = null)"
        >
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Benutzer löschen?</DialogTitle>
                    <DialogDescription>
                        Bist du sicher, dass du diesen Benutzer löschen
                        möchtest?
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="userToDelete = null">
                        Abbrechen
                    </Button>
                    <Button
                        :disabled="deleteForm.processing"
                        variant="destructive"
                        @click="deleteUser"
                    >
                        Löschen
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </MainLayout>
</template>
