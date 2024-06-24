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
import BigPlusIcon from "@/Components/Icons/BigPlusIcon.vue";
import BigBackIcon from "@/Components/Icons/BigBackIcon.vue";

const props = defineProps({
    permissions: {
        type: Object,
        default: () => ({}),
    },
});

const deleteForm = useForm({});

const deleteRecord = (id) => {
    if (confirm("Are you sure?")) {
        deleteForm.delete(route("permissions.destroy", id));
    }
};
</script>

<template>
    <Head title="Permissions" />

    <SidebarLayout>
        <template #header>

            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Permissions
                </h2>
                <div>
                    <Link :href="route('permissions.create')" class="uppercase">
                        <BigPlusIcon />
                    </Link>
                </div>
            </div>

        </template>

        <div class="">
            <div class="space-y-4">
                <div class="shadow-md p-4 rounded-lg bg-white">
                    <div class="flex items-center justify-between  mb-3">
                        <div>
                            <pagination class="mt-2" :links="permissions.links" />
                        </div>

                        <div>
                            <Link :href="route('roles.index')" class="uppercase  flex"><BigBackIcon /></Link>
                        </div>
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
                                        v-if="permissions.data.length == 0"
                                    >
                                        There is no records yet. Start adding.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(permission, index) in permissions.data"
                                    :key="index"
                                >
                                    <td>{{ permission.id }}</td>
                                    <td>{{ permission.name }}</td>
                                    <td>
                                        <div class="space-x-2">
                                            <Link
                                                :href="
                                                    route('permissions.edit', permission.id)
                                                "
                                            >
                                                <PrimaryButton>
                                                    <EditIcon />
                                                </PrimaryButton>
                                            </Link>

                                            <DangerButton
                                                @click="deleteRecord(permission.id)"
                                            >
                                                <DeleteIcon />
                                            </DangerButton>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <pagination class="mt-2" :links="permissions.links" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
