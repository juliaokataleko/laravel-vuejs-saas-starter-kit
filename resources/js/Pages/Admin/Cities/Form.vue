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
import { onMounted, ref } from "vue";

const props = defineProps({
    city: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: props.city.name,
    country_id: props.city.country_id,
    state_id: props.city.state_id
});

const submitForm = () => {

    if (props.city.id) {
        form.put(route('cities.update', props.city.id))
        return
    }

    form.post(route('cities.store'))
}

const countries = ref([])
const states = ref([])

const getCountries = () => {
    axios.get(route('api.countries')).then((response) => {
        if (response.data) {
            countries.value = response.data
        }
    })   
}

const getStates = () => {
    if (form.country_id) {
        axios.get(route('api.countryStates', form.country_id)).then((response) => {
            if (response.data) {
                states.value = response.data
            }
        })
    }    
}


onMounted(() => {
    getCountries()
    if (form.country_id) {
        getStates()
    }
})

</script>

<template>
    <Head :title="city.id ? 'Edit city' : 'Add city'" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ city.id ? "Edit city" : "Add city" }}
                </h2>
                <div>
                    <Link :href="route('cities.index')" class="uppercase"
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

                            <select class="form-input w-full" name="state_id" id="state_id" v-model="form.state_id">
                                <option value="">Select the state</option>
                                <option v-for="(state, index) in states" :key="index" :value="state.id">{{ state.name }}</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.state_id"
                            />
                        </div>


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
