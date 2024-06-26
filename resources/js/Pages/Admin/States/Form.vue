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
    state: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: props.state.name,
    country_id: props.state.country_id
});

const submitForm = () => {

    if (props.state.id) {
        form.put(route('states.update', props.state.id))
        return
    }

    form.post(route('states.store'))
}

const countries = ref([])

const getCountries = () => {
    axios.get(route('api.countries')).then((response) => {
        if (response.data) {
            countries.value = response.data
        }
    })   
}

onMounted(() => {
    getCountries()
})

</script>

<template>
    <Head :title="state.id ? 'Edit state' : 'Add state'" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ state.id ? "Edit state" : "Add state" }}
                </h2>
                <div>
                    <Link :href="route('states.index')" class="uppercase"
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

                            <select class="form-input w-full" name="country_id" id="country_id" v-model="form.country_id">
                                <option value="">Select the country</option>
                                <option v-for="(country, index) in countries" :key="index" :value="country.id">{{ country.name }}</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.country_id"
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
