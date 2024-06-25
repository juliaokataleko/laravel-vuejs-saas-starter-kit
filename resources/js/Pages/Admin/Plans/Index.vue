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
import Toggle from "@/Components/Toggle.vue";
import { VMoney } from 'v-money';
import { ref } from "vue";

const money = ref({
   decimal: ',',
   thousands: '.',
   prefix: '$ ',
   // suffix: ' #',
   precision: 2,
   masked: true
})

const props = defineProps({
    plans: {
        type: Object,
        default: () => ({}),
    },
});

const deleteForm = useForm({});

const deleteRecord = (id) => {
    if (confirm("Are you sure?")) {
        deleteForm.delete(route("plans.destroy", id));
    }
};
</script>

<template>
    <Head title="Plans" />

    <SidebarLayout>
        <template #header>

            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Plans
                </h2>
                <div>
                    <Link :href="route('plans.create')" class="uppercase">
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
                                    <th>Slug</th>
                                    <th>Monthly Price</th>
                                    <th>Active</th>
                                    <th>Is Free</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td
                                        colspan="7"
                                        v-if="plans.data.length == 0"
                                    >
                                        There is no records yet. Start adding.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(plan, index) in plans.data"
                                    :key="index"
                                >
                                    <td>{{ plan.id }}</td>
                                    <td>{{ plan.name }}</td>
                                    <td>{{ plan.slug }}</td>
                                    <td>
                                        <input type="text" disabled class=" border border-gray-50 p-1 rounded-md " v-model="plan.monthly_price"  v-money="money">
                                    </td>
                                    <td>
                                        <Toggle :status="plan.active" />
                                    </td>
                                    <td>
                                        <Toggle :status="plan.is_free" />
                                    </td>
                                    <td>
                                        <div class="space-x-2">
                                            <Link
                                                :href="
                                                    route('plans.edit', plan.id)
                                                "
                                            >
                                                <PrimaryButton>
                                                    <EditIcon />
                                                </PrimaryButton>
                                            </Link>

                                            <DangerButton
                                                @click="deleteRecord(plan.id)"
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
                        <pagination class="mt-2" :links="plans.links" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
