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
    payments: {
        type: Object,
        default: () => ({}),
    },
});

const deleteForm = useForm({});

const deleteRecord = (id) => {
    if (confirm("Are you sure?")) {
        deleteForm.delete(route("payments.destroy", id));
    }
};
</script>

<template>
    <Head title="Payments" />

    <SidebarLayout>
        <template #header>

            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Payments
                </h2>
                <div>
                    <Link :href="route('payments.create')" class="uppercase">
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
                                    <th>Subscription</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date Interval</th>
                                    <th>Date Created</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td
                                        colspan="6"
                                        v-if="payments.data.length == 0"
                                    >
                                        There is no records yet. Start adding.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(payment, index) in payments.data"
                                    :key="index"
                                >
                                    <td>{{ payment.id }}</td>
                                    <td>{{ payment.subscription.id }} - {{ payment.subscription.business.name }}</td>
                                    
                                    <td>
                                        <input type="text" disabled class=" border border-gray-50 p-1 rounded-md " v-model="payment.amount"  v-money="money">
                                    </td>
                                    
                                    <td>
                                        <select
                                            class="form-input w-full"
                                            name="status"
                                            id="status"
                                            disabled
                                            v-model="payment.status"
                                        >
                                            <option value="">Select</option>
                                            <option value="succeeded">Succeeded</option>
                                            <option value="canceled">Canceled</option>
                                            <option value="failed">Failed</option>
                                        </select>
                                    </td>

                                    <td>
                                        {{ payment.start_date }} 
                                        <hr>
                                        {{ payment.end_date }} 
                                    </td>
                                    <td>
                                        {{ payment.created_at }}
                                    </td>
                                    <td>
                                        <div class="space-x-2">
                                            <Link
                                                :href="
                                                    route('payments.edit', payment.id)
                                                "
                                            >
                                                <PrimaryButton>
                                                    <EditIcon />
                                                </PrimaryButton>
                                            </Link>

                                            <DangerButton
                                                @click="deleteRecord(payment.id)"
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
                        <pagination class="mt-2" :links="payments.links" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
