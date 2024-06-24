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

const props = defineProps({
    logs: {
        type: Object,
        default: () => ({}),
    },
});

const deleteForm = useForm({});

const deleteRecord = (id) => {
    if (confirm("Are you sure?")) {
        deleteForm.delete(route("logs.destroy", id));
    }
};
</script>

<template>
    <Head title="Logs" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    Logs
                </h2>
                <!-- <div>
                    <Link :href="route('roles.create')" class="uppercase"
                        > <BigPlusIcon /> </Link
                    >
                </div> -->
            </div>
        </template>

        <div class="">
            <div class="space-y-4">
                <div class="shadow-md p-4 rounded-lg bg-white">
  
                    <div class="overflow-x-auto w-full">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Descriptions</th>
                                    <th>Causer</th>
                                    <th>Time</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td
                                        colspan="3"
                                        v-if="logs.data.length == 0"
                                    >
                                        There is no records yet. Start adding.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(log, index) in logs.data"
                                    :key="index"
                                >
                                    <td>{{ log.id }}</td>
                                    <td>{{ log.description }}</td>
                                    <td> {{ log.causer?.name }} </td>
                                    <td> {{ log.created_at }} </td>
                                    <td>
                                        <div class="space-x-2">
                                            <DangerButton
                                                @click="deleteRecord(log.id)"
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
                        <pagination class="mt-2" :links="logs.links" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
