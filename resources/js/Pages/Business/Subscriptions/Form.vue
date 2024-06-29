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
import BigBackIcon from "@/Components/Icons/BigBackIcon.vue";
import Textarea from "@/Components/Textarea.vue";
import Toggle from "@/Components/Toggle.vue";
import { onMounted, ref } from "vue";
import axios from "axios";
import PaymentForm from "./Partials/PaymentForm.vue";
import { VMoney } from 'v-money';

const money = ref({
   decimal: ',',
   thousands: '.',
   prefix: '$ ',
   // suffix: ' #',
   precision: 2,
   masked: true
})

const props = defineProps({
    subscription: {
        type: Object,
        default: () => ({}),
    },
    payment: {
        type: Object,
        default: () => ({}),
    }
});

const businesses = ref([]);
const plans = ref([]);

const getBusinesses = () => {
    axios.get(route("api.businesses.index")).then((response) => {
        if (response.data) {
            businesses.value = response.data;
        }
    });
};

const getPlans = () => {
    axios.get(route("api.plans.index")).then((response) => {
        if (response.data) {
            plans.value = response.data;
        }
    });
};

const form = useForm({
    plan_id: props.subscription.plan_id,
    billing_cycle: props.subscription.billing_cycle,
    active: props.subscription.active,
    amount: props.subscription.amount,
    status: props.subscription.status,
    is_trial: props.subscription.is_trial,
    start_date: props.subscription.start_date,
    end_date: props.subscription.end_date,
});

const submitForm = () => {
    console.log(route("business.subscriptions.store"));
    if (props.subscription.id) {
        form.put(route("business.subscriptions.update", props.subscription.id));
        return;
    }

    form.post(route("business.subscriptions.store"));
};

onMounted(() => {
    getBusinesses();
    getPlans();
});

</script>

<template>
    <Head :title="subscription.id ? 'Edit subscription' : 'Add subscription'" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{
                        subscription.id
                            ? "Edit subscription"
                            : "Add subscription"
                    }}
                </h2>
                <div>
                    <Link :href="route('business.subscriptions.index')" class="uppercase"
                        ><BigBackIcon
                    /></Link>
                </div>
            </div>
        </template>

        <div class="">
            <div class="space-y-6">

                <div class="shadow-md p-4 rounded-lg bg-white">
                    <div class="grid grid-cols-2 gap-5">

                        <div>
                            <InputLabel for="plan_id" value="Plan" />

                            <select
                                class="form-input w-full"
                                name="plan_id"
                                id="plan_id"
                                v-model="form.plan_id"
                            >
                                <option value="">Select the plan</option>
                                <option
                                    v-for="(plan, index) in plans"
                                    :key="index"
                                    :value="plan.id"
                                >
                                    {{ plan.name }}
                                </option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.plan_id"
                            />
                        </div>

                        <div>
                            <InputLabel for="amount" value="Valor" />

                            <TextInput
                                id="amount"
                                type="text"
                                v-money="money"
                                class="mt-1 block w-full"
                                v-model="form.amount"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.amount"
                            />
                        </div>

                        <div class="">
                            <InputLabel for="billing_cycle" value="Billing Cycle" />

                            <select
                                class="form-input w-full"
                                name="billing_cycle"
                                id="billing_cycle"
                                v-model="form.billing_cycle"
                            >
                                <option value="">Select</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="semiannually">Semiannually</option>
                                <option value="yearly">Yearly</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.billing_cycle"
                            />
                        </div>

                      
                            <div>
                                <InputLabel for="start_date" value="Start Date" />

                                <TextInput
                                    id="start_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.start_date"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.start_date"
                                />
                            </div>

                            <div>
                                <InputLabel for="end_date" value="End Date" />

                                <TextInput
                                    id="end_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.end_date"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.end_date"
                                />
                            </div>


                        <div class="flex items-center gap-4 col-span-2">
                            <PrimaryButton
                                :disabled="form.processing"
                                @click="submitForm()"
                                >Save</PrimaryButton
                            >

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p
                                    v-if="form.recentlySuccessful"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    Saved.
                                </p>
                            </Transition>
                        </div>
                    </div>
                </div>

                <div v-if="subscription.id" class="shadow-md p-4 rounded-lg bg-white">
                    <PaymentForm :payment="payment" />
                </div>

            </div>
        </div>
    </SidebarLayout>
</template>
