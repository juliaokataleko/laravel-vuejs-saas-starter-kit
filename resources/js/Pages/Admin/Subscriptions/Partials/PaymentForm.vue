<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
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
    payment: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props.payment.id,
    subscription_id: props.payment.subscription_id,
    start_date: props.payment.start_date,
    end_date: props.payment.end_date,
    amount: props.payment.amount,
    payment_method: props.payment.payment_method,
    status: props.payment.status,
})

const submitForm = () => {
    if (props.payment.id) {
        form.put(route("payments.update", props.payment.id));
        return;
    }

    form.post(route("payments.store"), {
        onSuccess: () => {
            // alert("Payment saved")
            // window.location.href = route('subscriptions.edit', payment.subscription_id)
        }
    });
};

</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="text-lg font-bold col-span-1 md:col-span-2">Payment Form</div>

        <div class="font-bold col-span-1 md:col-span-2">
            <InputLabel for="payment_method" value="Payment Method" />

            <div class="flex items-center space-x-6">
                <div>
                    <label for="cash" class=" flex items-center space-x-1">
                        <input type="radio" name="payment_method" value="cash"id="cash" v-model="form.payment_method" />
                        <span>Cash</span>
                    </label>
                </div>

                <div>
                    <label for="paypal" class=" flex items-center space-x-1">
                        <input type="radio" name="payment_method" value="paypal" id="paypal" v-model="form.payment_method" />
                        <span>Paypal</span>
                    </label>
                </div>

                <div>
                    <label for="credit" class=" flex items-center space-x-1">
                        <input type="radio" name="payment_method" id="credit" value="credit_card" v-model="form.payment_method" />
                        <span>Credit Card</span>
                    </label>
                </div>

                <div>
                    <label for="deposit" class=" flex items-center space-x-1">
                        <input type="radio" name="deposit" id="deposit" value="deposit" v-model="form.payment_method" />
                        <span>Deposit</span>
                    </label>
                </div>

            </div>

            <InputError class="mt-2" :message="form.errors.payment_method" />
        </div>

        <div>
            <InputLabel for="amount" value="Amount" />
            <TextInput
                id="amount"
                type="text"
                class="mt-1 block w-full"
                v-model="form.amount"
                v-money="money"
            />

            <InputError class="mt-2" :message="form.errors.amount" />
        </div>

        <div>
            <InputLabel for="status" value="Status" />

            <select
                class="form-input w-full"
                name="status"
                id="status"
                v-model="form.status"
            >
                <option value="">Select</option>
                <option value="succeeded">Succeeded</option>
                <option value="canceled">Canceled</option>
                <option value="failed">Failed</option>
            </select>

            <InputError
                class="mt-2"
                :message="form.errors.status"
            />
        </div>

        <div>
            <InputLabel for="start_date" value="Start date" />
            <TextInput
                id="start_date"
                type="date"
                class="mt-1 block w-full"
                v-model="form.start_date"
            />

            <InputError class="mt-2" :message="form.errors.start_date" />
        </div>

        <div>
            <InputLabel for="end_date" value="End date" />
            <TextInput
                id="end_date"
                type="date"
                class="mt-1 block w-full"
                v-model="form.end_date"
            />

            <InputError class="mt-2" :message="form.errors.end_date" />
        </div>

        <div class="flex items-center gap-4">
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
</template>
