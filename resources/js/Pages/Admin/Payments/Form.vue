<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import SidebarLayout from "@/Layouts/SidebarLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import VueMultiselect from "vue-multiselect";
import BigBackIcon from "@/Components/Icons/BigBackIcon.vue";
import PaymentForm from "../Subscriptions/Partials/PaymentForm.vue";

const props = defineProps({
    payment: {
        type: Object,
        default: () => ({}),
    },
});


</script>

<template>
    <Head :title="payment.id ? 'Edit payment' : 'Add payment'" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ payment.id ? "Edit payment" : "Add payment" }}
                </h2>
                <div>
                    <Link :href="route('payments.index')" class="uppercase"
                        ><BigBackIcon /></Link
                    >
                </div>
            </div>
        </template>

        <div class="">
            <div class="space-y-4">
                <div class="shadow-md p-4 rounded-lg bg-white">
                    <PaymentForm :payment="payment" />
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
