<script setup>
import { Head } from '@inertiajs/vue3';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';

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
                        <img src="/assets/images/wellcome.webp" class=" w-full rounded-2xl hover:translate-y-3 transition-all duration-200" alt="">
                    </div>

                </div>
            </div>
        </div>

    </WebsiteLayout>

</template>