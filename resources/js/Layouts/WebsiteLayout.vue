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
import FacebookIcon from "@/Components/Icons/FacebbokIcon.vue"
import GithubIcon from "@/Components/Icons/GithubIcon.vue"

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

        <div class="bg-slate-800">
            <div class=" max-w-[1500px] grid grid-cols-1 md:grid-cols-3 py-[70px] gap-12 h-full w-full px-5 mx-auto">

                <!-- About Company . [PUT HERE YOUR COMPANY ABOUT] -->
                <div class=" space-y-3">
                    <div>
                        <Link :href="route('home')" class=" flex items-center space-x-3">
                        <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-300 dark:text-gray-200"
                        />
                        <span class=" text-xl text-white">Laravel Saas Starter</span>
                    </Link>
                    </div>
                    <div class="text-md text-slate-400 space-y-3">
                        <p>Laravel Saas Starter Is A script developed to help programmers or companies to develop fastly their saas applications</p>
                        <p>In LSS, we can find, locations like countries, states and cities, businesses crud, users crud with roles and permissions, 
                            activity log management, features, faqs, countries taxes, subscriptions and payments, a saas dashboard and so ON.
                        </p>
                    </div>

                    <div class="text-slate-200">
                        &copy; {{ new Date().getFullYear() }} - LSS
                    </div>
                </div>
                <!-- END About Company . [PUT HERE YOUR COMPANY ABOUT] -->

                <!-- Footer Links -->
                <div class="space-y-4 footer-links">
                    <div class="text-xl font-bold text-white">Company</div>
                    <div class=" space-y-3">
                        <div><Link href="/">About company</Link></div>
                        <div><Link :href="route('contact')">Contacts us</Link></div>
                        <div><Link href="#pricing">Pricing</Link></div>
                        <div><Link href="#features">Our Features</Link></div>
                        <div><Link href="#faqs">Faqs</Link></div>
                    </div>

                    <div class="text-slate-300">
                        Address: Morro da Graça, Municipio de Benguela <br>
                        Benguela - Angola
                    </div>

                </div>
                <!-- End Footer Links -->

                <!-- Footer Links -->
                <div class="space-y-4 footer-links">
                    <div class="text-xl font-bold text-white">We are in the Internet</div>
                    <div class=" space-y-3">
                        <div>
                            <Link href="/" class="flex items-center space-x-4">
                                <span>
                                    <FacebookIcon />
                                </span> 
                                <span>Facebook</span>
                            </Link>
                        </div>
                        <div>
                            <a href="https://github.com/juliaokataleko/laravel-vuejs-saas-starter-kit" target="_blank" class="flex items-center space-x-4">
                                <span>
                                   <GithubIcon />
                                </span> 
                                <span>Github</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End Footer Links -->

            </div>
        </div>
       
    </div>
</template>
