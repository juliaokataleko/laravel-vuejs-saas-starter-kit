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

})

watch(usePage().props.flash, () => {
})

</script>

<template>
    <div class=" min-h-screen bg-slate-50">

        <div class="h-20 bg-slate-700 bg-opacity-40 w-full fixed top-0 left-0 right-0">
            <div class=" max-w-[1500px] h-full w-full flex items-center justify-between  px-5 mx-auto">
                <div>
                    <Link :href="route('home')" class=" flex items-center space-x-3">
                        <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-300 dark:text-gray-200"
                        />
                        <span class=" text-xl text-white">Laravel Saas Starter</span>
                    </Link>
                </div>

                <div class=" space-x-2">

                    <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="site-navbutton">Dashboard</Link>
                    <Link v-if="!$page.props.auth.user" :href="route('login')" class="site-navbutton">Log In</Link>
                    <Link v-if="!$page.props.auth.user" :href="route('register')" class="site-navbutton">Sign Up</Link>

                </div>
            </div>
        </div>

        <div>

            <slot />

        </div>

        <div class="footer">
            
        </div>
       
    </div>
</template>
