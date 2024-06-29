<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import SidebarLayout from "@/Layouts/SidebarLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import Toggle from "@/Components/Toggle.vue";
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import BigBackIcon from "@/Components/Icons/BigBackIcon.vue";

const props = defineProps({
    feature: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    title: props.feature.title,
    content: props.feature.content,
    is_published: props.feature.is_published,
});

const submitForm = () => {

    if (props.feature.id) {
        form.put(route('features.update', props.feature.id))
        return
    }

    form.post(route('features.store'))
}
</script>

<template>
    <Head :title="feature.id ? 'Edit feature' : 'Add feature'" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ feature.id ? "Edit feature" : "Add feature" }}
                </h2>
                <div>
                    <Link :href="route('features.index')" class="uppercase"
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
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                                autocomplete="title"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
                            />
                        </div>

                        <div>
                            <InputLabel for="content" value="Content" />

                            <Textarea
                                id="content"
                                class="mt-1 block w-full"
                                v-model="form.content"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.content"
                            />
                        </div>

                        <div>
                            <InputLabel for="is_published" value="Is Published" />
                            <Toggle
                                :status="form.is_published"
                                @click="form.is_published = !form.is_published"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.is_published"
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
