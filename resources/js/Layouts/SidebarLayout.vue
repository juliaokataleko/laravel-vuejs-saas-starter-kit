<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import SidebarLink from "@/Components/SidebarLink.vue";
import { onMounted } from "vue";
import Swal from 'sweetalert2'
import { watch } from "vue";

const showingSidemenuToogle = ref(true);
const sidemenuToogle = () => {
    showingSidemenuToogle.value = !showingSidemenuToogle.value
}

onMounted(() => {
    const screenWidth = window.innerWidth
    if (screenWidth < 705) showingSidemenuToogle.value = false

    if (usePage().props.flash?.success) {
        Swal.fire({
            title: "Yes!",
            text: usePage().props.flash?.success,
            icon: "success"
        });
    }

    if (usePage().props.flash?.error) {
        Swal.fire({
            title: "Oh No!",
            text: usePage().props.flash?.error,
            icon: "error"
        });
    }
    
    if (usePage().props.flash?.warning) {
        Swal.fire({
            title: "Opps!",
            text: usePage().props.flash?.warning,
            icon: "warning"
        });
    }
})

watch(usePage().props.flash, () => {
    console.log(usePage().props);
})

</script>

<template>
    <div>
        <div class="min-h-screen flex bg-gray-100 flex dark:bg-gray-900">
            <!-- Start Sidebar -->
            <div class="h-screen bg-slate-800 w-[300px] fixed md:relative top-0 left-0 bottom-0" :class="{'hidden': !showingSidemenuToogle}">

                <div class="h-16 shadow shadow-slate-700 flex items-center px-4">
                    <Link :href="route('dashboard')" class=" flex items-center space-x-3">
                        <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-300 dark:text-gray-200"
                        />
                        <span class=" text-xl text-white">App Name</span>
                    </Link>
                </div>

                <div class="links h-[calc(100vh-64px)] overflow-y-auto">
                    <div class="px-4 pt-4 space-y-2">
                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                </svg>

                                <span>
                                    Dashboard
                                </span>

                            </SidebarLink>
                        </div>


                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>

                                <span>
                                    Businesses
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>

                                <span>
                                    Plans
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>

                                <span>
                                    Subscriptions
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>

                                <span>
                                    Payments
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>

                                <span>
                                    Countries
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>

                                <span>
                                    States
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>

                                <span>
                                    Cities
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('users.index')" :active="route().current('users.*')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>

                                <span>
                                    Users
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('roles.index')" :active="route().current('roles.*')">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                </svg>

                                <span>
                                    Roles and Permissions
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('logs.index')" :active="route().current('logs.*')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                <span>
                                    Logs
                                </span>

                            </SidebarLink>
                        </div>

                        <div>
                            <SidebarLink :href="route('profile.edit')" :active="route().current('profile.edit')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>

                                <span>
                                    Profile
                                </span>

                            </SidebarLink>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- Main Content -->
            <div
                class="h-screen overflow-y-auto  bg-zinc-50"
                :class="{'w-full md:w-[calc(100vw-300px)] ': showingSidemenuToogle, 'w-full': !showingSidemenuToogle}"
            >
                <div class=" bg-white shadow-md">
                    <div class="px-5 max-w-[1300px] mx-auto h-16 flex justify-between items-center space-x-3">
                        <div v-if="$slots.header" class=" flex-grow">
                            <div class="">
                                <slot name="header" />
                            </div>
                        </div>

                        <!-- <div class="">

                            <div v-if="$page.props.flash.message" :class="`my-3 ${$page.props.flash.class}`">
                                <span v-html="$page.props.flash.message"></span>
                            </div>

                            <div v-if="$page.props.flash.success"
                                :class="`my-3 mt-6 p-3 text-white bg-green-700 rounded-lg text-center`">
                                <span v-html="$page.props.flash.success"></span>
                            </div>

                            <div v-if="$page.props.flash.error"
                                :class="`my-3 mt-6 p-3 text-center text-white bg-red-700 rounded-lg`">
                                <span v-html="$page.props.flash.error"></span>
                            </div>

                            <div v-if="$page.props.flash.warning"
                                :class="`my-3 mt-6 p-3 text-center text-white bg-orange-700 rounded-lg`">
                                <span v-html="$page.props.flash.warning"></span>
                            </div>

                        </div> -->

                        <div class=" flex items-center space-x-2">
                            <div class="border p-1 px-2 bg-slate-50 rounded-lg flex items-center">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </span>
                                <input type="text" class=" w-16 border-none p-1 bg-transparent outline-none" placeholder="Search" />
                            </div>

                            <button class="border border-slate-300 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                            </button>
                            <button class="border border-slate-300 p-2 rounded-lg" @click="sidemenuToogle()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                                </svg>
                            </button>

                        </div>
                    </div>
                </div>
                <div>
                    <div class="px-5 max-w-[1300px] mx-auto py-8">

                    <slot />
                    </div>
                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>
</template>
