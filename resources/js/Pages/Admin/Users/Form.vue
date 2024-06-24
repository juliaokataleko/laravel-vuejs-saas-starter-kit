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

const props = defineProps({
    user: {
        type: Object,
        default: () => ({}),
    },
    roles: {
        type: Object,
        default: () => ({}),
    },
    businesses: {
        type: Object,
        default: () => ({}),
    }
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role,
    business_id: props.user.business_id
});

const submitForm = () => {

    if (props.user.id) {
        form.put(route('users.update', props.user.id))
        return
    }

    form.post(route('users.store'))
}
</script>

<template>
    <Head :title="user.id ? 'Edit user' : 'Add user'" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ user.id ? "Edit user" : "Add user" }}
                </h2>
                <div>
                    <Link :href="route('users.index')" class="uppercase"
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

                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div>
                            <InputLabel for="business_id" value="Business" />

                            <select class="form-input w-full" name="business_id" id="business_id" v-model="form.business_id">
                                <option value="">Select a business</option>
                                <option v-for="(business, index) in businesses" :key="index" :value="business.id">{{ business.name }}</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.business_id"
                            />
                        </div>

                        <div>
                            <InputLabel for="role" value="Role" />

                            <select class="form-input w-full" name="role" id="role" v-model="form.role">
                                <option value="">Select a role</option>
                                <option v-for="(role, index) in roles" :key="index" :value="role.id">{{ role.name }}</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.role"
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
