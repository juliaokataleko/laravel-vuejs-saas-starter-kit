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
import { onMounted, ref } from "vue";
import axios from "axios";
import CleanLayout from "@/Layouts/CleanLayout.vue";

const props = defineProps({
    business: {
        type: Object,
        default: () => ({}),
    },
    countries: {
        type: Object,
        default: () => ({}),
    }
});

const states = ref([])
const cities = ref([])

const getStates = () => {
    if (form.country_id) {
        axios.get(route('api.countryStates', form.country_id)).then((response) => {
            if (response.data) {
                states.value = response.data
            }
        })
    }    
}

const getCities = () => {
    if (form.state_id) {
        axios.get(route('api.stateCities', form.state_id)).then((response) => {
            if (response.data) {
                cities.value = response.data
            }
        })
    }    
}

const form = useForm({
    name: props.business.name,
    doc: props.business.doc,
    about: props.business.about,
    phone: props.business.phone,
    email: props.business.email,
    active: props.business.active,
    country_id: props.business.country_id,
    state_id: props.business.state_id,
    city_id: props.business.city_id,
    address: props.business.address,
});

const submitForm = () => {

    if (props.business.id) {
        form.put(route('business.settings.update', props.business.id))
        return
    }

    console.log("Sending...");
    form.post(route('business.settings.store'))
}

onMounted(() => {
    if (props.business.country_id) {
        getStates()
    }

    if (props.business.state_id) {
        getCities()
    }
})

</script>

<template>
    <Head :title="business.id ? 'Edit your business' : 'Add your business'" />

    <CleanLayout>

        <div class="">
            <div class="space-y-4">

                <div v-if="business.id">
                    <Link :href="route('business.subscriptions.index')">
                        <PrimaryButton>Subscriptions</PrimaryButton>
                    </Link>
                </div>
                <div class="">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

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

                        <div>
                            <InputLabel for="doc" value="Doc Number" />

                            <TextInput
                                id="doc"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.doc"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.doc"
                            />
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.email"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div>
                            <InputLabel for="phone" value="Phone" />

                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.phone"
                            />
                        </div>

                        <div>
                            <InputLabel for="about" value="About" />

                            <Textarea
                                id="about"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.about"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.about"
                            />
                        </div>

                        <div>
                            <InputLabel for="country_id" value="Country" />

                            <select @change="getStates()" class="form-input w-full" name="country_id" id="country_id" v-model="form.country_id">
                                <option value="">Select the country</option>
                                <option v-for="(country, index) in countries" :key="index" :value="country.id">{{ country.name }}</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.country_id"
                            />
                        </div>

                        <div>
                            <InputLabel for="state_id" value="State" />

                            <select @change="getCities()" class="form-input w-full" name="state_id" id="state_id" v-model="form.state_id">
                                <option value="">Select the state</option>
                                <option v-for="(state, index) in states" :key="index" :value="state.id">{{ state.name }}</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.state_id"
                            />
                        </div>

                        <div>
                            <InputLabel for="city_id" value="City" />

                            <select class="form-input w-full" name="city_id" id="city_id" v-model="form.city_id">
                                <option value="">Select the city</option>
                                <option v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.state_id"
                            />
                        </div>

                        <div>
                            <InputLabel for="address" value="Address" />

                            <TextInput
                                id="address"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.address"
                            />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton 
                            @click="submitForm()"
                                >Save</PrimaryButton
                            >

                            <!-- <Transition
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
                            </Transition> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </CleanLayout>
</template>
