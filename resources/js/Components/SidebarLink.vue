<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'bg-zinc-700 rounded-xl shadow text-sm font-medium leading-5 text-white  focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes + ' block flex items-center space-x-2 p-2'">
        <slot />
    </Link>
</template>
