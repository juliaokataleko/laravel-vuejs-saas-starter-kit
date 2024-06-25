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
    subscriptions: {
        type: Object,
        default: () => ({}),
    },
});

const deleteForm = useForm({});

const deleteRecord = (id) => {
    if (confirm("Are you sure?")) {
        deleteForm.delete(route("subscriptions.destroy", id));
    }
};
</script>

<template>
    <Head title="Subscriptions" />

    <SidebarLayout>
        <template #header>

            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Subscriptions
                </h2>
                <div>
                    <Link :href="route('subscriptions.create')" class="uppercase">
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
                                    <th>Plan</th>
                                    <td>Business</td>
                                    <th>Amount</th>
                                    <th>Start Date</th>
                                    <th>End date</th>
                                    <th>Active</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td
                                        colspan="6"
                                        v-if="subscriptions.data.length == 0"
                                    >
                                        There is no records yet. Start adding.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(subscription, index) in subscriptions.data"
                                    :key="index"
                                >
                                    <td>{{ subscription.id }}</td>
                                    <td>{{ subscription.plan.name }}</td>
                                    <td>{{ subscription.business.name }}</td>
                                    <td>
                                        <input type="text" disabled class=" border border-gray-50 p-1 rounded-md " v-model="subscription.amount"  v-money="money">
                                    </td>
                                    <td>{{ subscription.start_date }}</td>
                                    <td>{{ subscription.end_date }}</td>
                                    <td>
                                        <Toggle :status="subscription.active" />
                                    </td>
                                    <td>
                                        <div class="space-x-2">
                                            <Link
                                                :href="route('subscriptions.edit', subscription.id)"
                                            >
                                                <PrimaryButton>
                                                    <EditIcon />
                                                </PrimaryButton>
                                            </Link>

                                            <DangerButton
                                                @click="deleteRecord(subscription.id)"
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
                        <pagination class="mt-2" :links="subscriptions.links" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
