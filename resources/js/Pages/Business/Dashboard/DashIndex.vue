<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import SidebarLayout from "@/Layouts/SidebarLayout.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import EditIcon from "@/Components/Icons/EditIcon.vue";
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";
import BigPlusIcon from "@/Components/Icons/BigPlusIcon.vue";
import BigBackIcon from "@/Components/Icons/BigBackIcon.vue";
import { VMoney } from 'v-money';
import { ref } from "vue";
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


const money = ref({
   decimal: ',',
   thousands: '.',
   prefix: '$ ',
   // suffix: ' #',
   precision: 2,
   masked: true
})

const props = defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});

// const revenueChartData = {
//     labels: props.data.month_revenue.labels,
//     datasets: [ { data: props.data.month_revenue.data,label: 'Revenues', } ]
// }

// const revenueChartOptions = {
//     responsive: true,
//     plugins: {
//       legend: {
//         position: 'top',
//       },
//       title: {
//         display: true,
//         text: 'Monthly Revenues'
//       }
//     }
// }

</script>

<template>
    <Head title="Dashboard" />

    <SidebarLayout>
        <template #header>

            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Saas Dashboard
                </h2>
                <div>
                    <!-- <Link :href="route('permissions.create')" class="uppercase">
                        <BigPlusIcon />
                    </Link> -->
                </div>
            </div>

        </template>

        <div class="">
            <div class="space-y-4">
                <div class=" grid grid-cols-3 gap-5">

                    <!-- <div class="shadow-md p-3 bg-white rounded-lg space-y-4">
                        <div class="text-lg">MRR</div>
                        <div class=" text-2xl font-bold">
                            <input type="text" disabled v-model="data.total_monthly_mrr" v-money="money" class=" w-48 text-3xl border-none p-0" 
                            style="margin: 0;padding: 0; font-size: 40px;">
                        </div>
                    </div>

                    <div class="shadow-md p-3 bg-white rounded-lg space-y-4">
                        <div class="text-lg">Active Subscriptions</div>
                        <div class=" text-2xl font-bold">
                            <input type="text" disabled v-model="data.active_subscriptions"  class="w-48 text-3xl border-none p-0" 
                            style="margin: 0;padding: 0; font-size: 40px;">
                        </div>
                    </div> -->

                    <!-- <div class="col-span-3 grid grid-cols-2 gap-4 ">
                        <div class="bg-white shadow-md p-4 rounded-lg">
                            <Bar
                                id="my-chart-id"
                                aria-describedby="my-data-table"
                                aria-label="Sales figures for the years 2022 to 2024. Sales in 2022: 987, Sales in 2023: 1209, Sales in 2024: 825."
                                :options="revenueChartOptions"
                                :data="revenueChartData"
                            />
                        </div>

                        <div class="bg-white shadow-md p-4 rounded-lg">
                            <Bar
                                id="my-chart-id"
                                aria-describedby="my-data-table"
                                aria-label="Sales figures for the years 2022 to 2024. Sales in 2022: 987, Sales in 2023: 1209, Sales in 2024: 825."
                                :options="revenueChartOptions"
                                :data="revenueChartData"
                            />
                        </div>
                        
                    </div> -->
                    
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
