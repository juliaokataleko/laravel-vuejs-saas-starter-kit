<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import SidebarLayout from '@/Layouts/SidebarLayout.vue';

const props = defineProps({
    permissions: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <Head title="Profile" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Roles</h2>
                <div>
                    <Link :href="route('permissions')">New Role</Link>
                </div>
            </div>
        </template>

        <div class="">
            <div class=" space-y-4">

            </div>
        </div>
    </SidebarLayout>
</template>
