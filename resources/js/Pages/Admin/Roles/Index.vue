<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import SidebarLayout from "@/Layouts/SidebarLayout.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import EditIcon from "@/Components/Icons/EditIcon.vue";
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";

const props = defineProps({
    roles: {
        type: Object,
        default: () => ({}),
    },
});

const deleteForm = useForm({})

const deleteRecord = (id) => {
    if (confirm('Are you sure?')) {
        deleteForm.delete(route('roles.destroy', id))
    }
}
</script>

<template>
    <Head title="Roles" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    Roles
                </h2>
                <div>
                    <Link :href="route('roles.create')" class="uppercase"
                        >New</Link
                    >
                </div>
            </div>
        </template>

        <div class="">
            <div class="space-y-4">
                <div class="shadow-md p-4 rounded-lg bg-white">
                    <div>
                        <pagination class="mt-2" :links="roles.links" />
                    </div>

                    <div class="overflow-x-auto w-full">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td
                                        colspan="3"
                                        v-if="roles.data.length == 0"
                                    >
                                        There is no records yet. Start adding.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(role, index) in roles.data"
                                    :key="index"
                                >
                                    <td>{{ role.id }}</td>
                                    <td>{{ role.name }}</td>
                                    <td>
                                        <div class="space-x-2">
                                            <Link :href=" route('roles.edit', role.id)">
                                                <PrimaryButton>
                                                    <EditIcon />
                                                </PrimaryButton>
                                            </Link>

                                            <DangerButton @click="deleteRecord(role.id)">
                                                <DeleteIcon />
                                            </DangerButton>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <pagination class="mt-2" :links="roles.links" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
