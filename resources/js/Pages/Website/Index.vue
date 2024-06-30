<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
import { onMounted } from "vue";

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
    features: {
        type: Object,
        default: () => ({}),
    },
    plans: {
        type: Object,
        default: () => ({}),
    },
    faqs: {
        type: Object,
        default: () => ({}),
    },
});

onMounted(() => {});
</script>

<template>
    <Head title="Homepage" />

    <WebsiteLayout>
        <div class="wellcome-page min-h-screen w-full bg-gray-500">
            <div
                class="min-h-screen bg-blue-500 bg-opacity-50 flex items-center"
            >
                <div
                    class="max-w-[1500px] p-6 w-full grid grid-cols-1 md:grid-cols-2 gap-8 flex flex-col md:flex-row items-center justify-between px-5 mx-auto"
                >
                    <div>
                        <div class="text-[50px] font-bold text-white">
                            Your Saas Application Title
                        </div>
                        <div class="text-[30px] font-bold text-white">
                            Your Saas Application Subtitle
                        </div>
                    </div>

                    <div>
                        <img
                            src="/assets/images/saas-dash.png"
                            class="w-full rounded-2xl hover:translate-y-3 transition-all duration-200"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div id="features" class="bg-gray-500">
            <div
                class="max-w-[1500px] p-6 py-[120px] w-full grid grid-cols-1 md:grid-cols-2 gap-8 flex flex-col md:flex-row items-start justify-between px-5 mx-auto"
            >
                <div>
                    <div class="text-[50px] font-bold text-white">
                        What does we offer?
                    </div>
                    <div class="text-[30px] font-bold text-white">
                        Check our featues
                    </div>
                </div>

                <div>
                    <div class="space-y-4">
                        <div
                            class="w-full bg-white text-slate-700 p-4 flex space-x-3 rounded-lg shadow-md"
                            v-for="(feat, index) in features"
                            :key="index"
                        >
                            <div>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-14 h-14"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <div class="text-lg font-bold uppercase">
                                    {{ feat.title }}
                                </div>

                                <div>
                                    {{ feat.content }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Features -->

        <!-- Packages -->
        <div class="bg-slate-200" id="pricing">
            <div
                class="max-w-[1500px] p-6 py-[120px] w-full flex flex-col space-y-6 items-center justify-between px-5 mx-auto"
            >
                <div>
                    <div
                        class="text-[50px] font-bold text-slate-700 text-center"
                    >
                        Our plans
                    </div>
                    <div
                        class="text-[30px] font-bold text-slate-700 text-center"
                    >
                        Choose the best plan for business
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5 w-full">
                    <div
                        class="bg-white shadow-md hover:shadow-xl transition-all duration-100 rounded-lg p-4 space-y-5"
                        v-for="(plan, index) in plans"
                        :key="index"
                    >
                        <div class="text-xl">
                            {{ plan.name }}
                        </div>

                        <div class="text-3xl font-bold text-slate-950">
                            $ {{ plan.monthly_price }}
                        </div>

                        <div class="text-slate-700 min-h-20">
                            {{ plan.description }}
                        </div>

                        <div class="space-y-3">
                            <div
                                class="border border-gray-100 rounded-md p-2 grid grid-cols-2 gap-3"
                                v-for="(item, index) in plan.features"
                                :key="index"
                            >
                                <div>
                                    {{ item.feature_name }}
                                </div>

                                <div>
                                    <div v-if="item.feature_type != 'boolean'">
                                        {{ item.feature_default }}
                                    </div>

                                    <Toggle
                                        v-if="item.feature_type == 'boolean'"
                                        :status="item.feature_default"
                                    />
                                </div>

                            </div>
                        </div>

                        <div>
                            <Link :href="route('register')" class="plan-link">Get Started</Link>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Packages -->

        <!-- Faqs -->
        <div id="faqs" class="bg-blue-400">
            <div class="max-w-[1500px] p-6 py-[120px] w-full flex flex-col space-y-6 items-center justify-between px-5 mx-auto" >

                <div>
                    <div class="text-[50px] font-bold text-white">
                    Frequent Asked Questions
                    </div>
                </div>

                <div class="text-slate-700 space-y-5 w-full">

                    <div v-for="(faq, index) in faqs" :key="index" class=" space-y-5 border p-3 rounded-md bg-white">

                        <div>
                            <div @click="faq.open = !faq.open" class="text-lg cursor-pointer font-bold flex items-center space-x-3 select-none">
                                <div>
                                    <svg v-if="faq.open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>

                                    <svg v-if="!faq.open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>

                                </div>
                                <span>{{ faq.title }}</span>
                            </div>
                        </div>

                        <div v-if="faq.open">
                            {{ faq.content }}
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- End Faqs -->

    </WebsiteLayout>
</template>
