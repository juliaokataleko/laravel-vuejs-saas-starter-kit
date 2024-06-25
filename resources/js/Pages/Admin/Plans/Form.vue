<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import SidebarLayout from "@/Layouts/SidebarLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import BigBackIcon from "@/Components/Icons/BigBackIcon.vue";
import Textarea from "@/Components/Textarea.vue";
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
    plan: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: props.plan.name,
    description: props.plan.description,
    features: props.plan.features ?? [],

    monthly_price: props.plan.monthly_price,
    quarterly_price: props.plan.quarterly_price,
    semiannually_price: props.plan.semiannually_price,
    annually_price: props.plan.annually_price,

    is_free: props.plan.is_free,
    active: props.plan.active,
});

const submitForm = () => {

    if (props.plan.id) {
        form.put(route('plans.update', props.plan.id))
        return
    }

    form.post(route('plans.store'))
}

const addFeature = () => {
    form.features.push({
        feature_name: "",
        feature_type: "",
        feature_default: ""
    })
}

const removeFeature = (item) => {
    const index = form.features.indexOf(item);
    if (index > -1) { 
        form.features.splice(index, 1); 
    }
}
</script>

<template>
    <Head :title="plan.id ? 'Edit plan' : 'Add plan'" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ plan.id ? "Edit plan" : "Add plan" }}
                </h2>
                <div>
                    <Link :href="route('plans.index')" class="uppercase"
                        ><BigBackIcon /></Link
                    >
                </div>
            </div>
        </template>

        <div class="">
            <div class="space-y-4">
                <div class="shadow-md p-4 rounded-lg bg-white">
                    <div class="grid grid-cols-1 gap-3">

                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>

                        <!-- Features -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-2xl font-bold">
                                    Features
                                </div>
                                <div class="">
                                    <button class="text-lg font-bold" @click="addFeature()">
                                        Add feature
                                    </button>
                                </div>
                            </div>
                            <div class=" space-y-3">

                                <div class=" border border-gray-100 rounded-md p-2 grid grid-cols-3 gap-3"  v-for="(item, index) in form.features" :key="index">
                                    <div>
                                        <InputLabel for="feature_name" value="Name" />
                                        <TextInput
                                            id="feature_name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="item.feature_name"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel for="feature_type" value="Type" />
                                        <select class="form-input mt-1 w-full" name="feature_type" id="feature_type" v-model="item.feature_type">
                                            <option value="">Select a type</option>
                                            <option value="text">Input Text</option>
                                            <option value="number">Input Number</option>
                                            <option value="boolean">Boolean</option>
                                        </select>
                                    </div>

                                    <div>
                                        <InputLabel for="feature_default" value="Default Value" />
                                        <TextInput
                                            id="feature_default"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="item.feature_default"
                                        />
                                    </div>

                                    <div class="col-span-3">
                                        <button @click="removeFeature(item)" class="text-red-600">Remove</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Features -->

                        <div>
                            <InputLabel for="monthly_price" value="Monthly Price" />

                            <TextInput
                                id="monthly_price"
                                type="text"
                                v-money="money"
                                class="mt-1 block w-full"
                                v-model="form.monthly_price"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.monthly_price"
                            />
                        </div>

                        <div>
                            <InputLabel for="quarterly_price" value="Quarterly Price" />

                            <TextInput
                                id="quarterly_price"
                                type="text"
                                v-money="money"
                                class="mt-1 block w-full"
                                v-model="form.quarterly_price"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.quarterly_price"
                            />
                        </div>

                        <div>
                            <InputLabel for="semiannually_price" value="Semiannually Price" />

                            <TextInput
                                id="semiannually_price"
                                type="text"
                                v-money="money"
                                class="mt-1 block w-full"
                                v-model="form.semiannually_price"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.semiannually_price"
                            />
                        </div>

                        <div>
                            <InputLabel for="annually_price" value="Annually Price" />

                            <TextInput
                                id="annually_price"
                                type="text"
                                v-money="money"
                                class="mt-1 block w-full"
                                v-model="form.annually_price"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.annually_price"
                            />
                        </div>

                        <div>
                            <InputLabel for="description" value="Description" />

                            <Textarea
                                id="description"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.description"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.description"
                            />
                        </div>

                        <div>
                            <InputLabel for="is_free" value="Is Free" />
                            <Toggle :status="form.is_free" @click="form.is_free = !form.is_free"/>
                            <InputError class="mt-2" :message="form.errors.is_free" />
                        </div>

                        <div>
                            <InputLabel for="active" value="Active" />
                            <Toggle :status="form.active" @click="form.active = !form.active"/>
                            <InputError class="mt-2" :message="form.errors.active" />
                        </div>
                       
                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing" @click="submitForm()"
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
            </div>
        </div>
    </SidebarLayout>
</template>
