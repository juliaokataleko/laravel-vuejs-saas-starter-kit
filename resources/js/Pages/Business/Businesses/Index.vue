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
import Toggle from "@/Components/Toggle.vue";

const props = defineProps({
    businesses: {
        type: Object,
        default: () => ({}),
    },
});

const deleteForm = useForm({});

const deleteRecord = (id) => {
    if (confirm("Are you sure?")) {
        deleteForm.delete(route("businesses.destroy", id));
    }
};
</script>

<template>
    <Head title="Businesses" />

    <SidebarLayout>
        <template #header>

            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Businesses
                </h2>
                <div>
                    <Link :href="route('businesses.create')" class="uppercase">
                        <BigPlusIcon />
                    </Link>
                </div>
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
                                    <th>Name</th>
                                    <td>Doc Number</td>
                                    <th>Slug</th>
                                    <th>Active</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td
                                        colspan="6"
                                        v-if="businesses.data.length == 0"
                                    >
                                        There is no records yet. Start adding.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(business, index) in businesses.data"
                                    :key="index"
                                >
                                    <td>{{ business.id }}</td>
                                    <td>{{ business.name }}</td>
                                    <td>{{ business.doc }}</td>
                                    <td>{{ business.slug }}</td>
                                    <td>
                                        <Toggle :status="business.active" />
                                    </td>
                                    <td>
                                        <div class="space-x-2">
                                            <Link
                                                :href="route('businesses.edit', business.id)"
                                            >
                                                <PrimaryButton>
                                                    <EditIcon />
                                                </PrimaryButton>
                                            </Link>

                                            <DangerButton
                                                @click="deleteRecord(business.id)"
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
                        <pagination class="mt-2" :links="businesses.links" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
