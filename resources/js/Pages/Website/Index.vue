<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { onMounted } from 'vue';

const props = defineProps({
    features: {
        type: Object,
        default: () => ({})
    },
    plans: {
        type: Object,
        default: () => ({})
    }
})

onMounted(() => {
   
})

</script>

<template>
    <Head title="Homepage" />

    <WebsiteLayout>

        <div class="wellcome-page min-h-screen w-full bg-gray-500">
            <div class="min-h-screen bg-blue-500 bg-opacity-50 flex items-center">
                <div class=" max-w-[1500px] p-6 w-full grid grid-cols-1 md:grid-cols-2 gap-8 flex flex-col md:flex-row items-center justify-between  px-5 mx-auto">

                    <div>
                        <div class="text-[50px] font-bold text-white">
                            Your Saas Application Title
                        </div>
                        <div class="text-[30px] font-bold text-white">
                            Your Saas Application Sutitle
                        </div>
                    </div>

                    <div>
                        <img src="/assets/images/saas-dash.png" class=" w-full rounded-2xl hover:translate-y-3 transition-all duration-200" alt="">
                    </div>

                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="bg-gray-500">
            <div class=" max-w-[1500px] p-6 py-[120px] w-full grid grid-cols-1 md:grid-cols-2 gap-8 flex flex-col md:flex-row items-start justify-between  px-5 mx-auto">

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
                            <div class="w-full bg-white p-4 flex space-x-3 rounded-lg shadow-md" v-for="(feat, index) in features" :key="index">

                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                    class="w-14 h-14">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
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
        <div class="bg-slate-200">
            <div class=" max-w-[1500px] p-6 py-[120px] w-full flex flex-col space-y-6 items-center justify-between  px-5 mx-auto">

                    <div>
                        <div class="text-[50px] font-bold text-slate-700 text-center">
                            Our plans
                        </div>
                        <div class="text-[30px] font-bold text-slate-700 text-center">
                            Choose the best plan for business
                        </div>
                    </div>

                    <div class=" grid grid-cols-1 md:grid-cols-3 gap-5 w-full">

                        <div class=" bg-white shadow-md rounded-lg p-4" v-for="(plan, index) in plans" :key="index">

                            <div class="text-lg">
                                {{ plan.name }}
                            </div>

                        </div>
                        
                    </div>

            </div>
        </div>
        <!-- End Packages -->

    </WebsiteLayout>

</template>