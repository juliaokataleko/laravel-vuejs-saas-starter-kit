<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { VMoney } from 'v-money';
import { ref } from "vue";
import { onMounted } from "vue";

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
    image: "",
})

const submitForm = () => {
    if (props.payment.id) {
        form.post(route("payments.update", {
            payment: props.payment.id,
            _method: 'put'
        }));
        return;
    }

    form.post(route("payments.store"), {
        onSuccess: () => {
        }
    });
};

const imageUrl = ref(props.payment.image)
const imageId = ref("")

const setImage = (e) => {
    const file = e.target.files[0];
    imageUrl.value = URL.createObjectURL(file);
    form.image = e.target.files[0]
}

const clearImage = () => {

    if (imageId.value) {

        if (confirm("Tem certeza?")) {
            deleteForm.id = imageId.value,
            deleteForm.delete(route('files.destroy', imageId.value))

            form.image = ""
            imageUrl.value = ""
        }

    } else {
        form.image = ""
        imageUrl.value = ""
    }
}

const deleteForm = useForm({
    id: ""
})

onMounted(() => {
    if (props.payment.media.length == 1) {
        imageId.value = props.payment.media[0].id
    }
});

</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="text-lg font-bold col-span-1 md:col-span-2">Subscription Payment</div>

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


        <div class="col-span-2">Payment receive</div>
        <div class="border border-gray-200 rounded-xl p-3 hover:bg-gray-100 transition-all duration-200 flex items-center space-x-3 col-span-2">
            
            
            <img v-if="imageUrl" :src="imageUrl" class="h-20 w-20 md:w-40 md:h-40 object-cover rounded-full bg-white"  id="profileImage" alt="">
            <div>
                <label for="image" class="cursor-pointer text-lg">
                    <input @change="setImage" type="file" name="image" id="image" accept="" class="hidden">
                    Select an image
                </label>

                <div>
                    <button v-if="imageId || (form.image)" @click="clearImage" class=" border-2 border-red-500 rounded-lg p-1 px-5">X</button>
                </div>
            </div>
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
</template>
