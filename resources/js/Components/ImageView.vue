<script setup>
import { ref } from 'vue';


const props = defineProps({
    imageSrc: {
        type: String,
        default: () => (""),
    },
    small: {
        type: Boolean,
        default: true
    },
    rounded: {
        type: Boolean,
        default: false
    },
});

const showFullImg = ref(false)

</script>

<template>
    
    <img
        :src="imageSrc"
        class="object-cover bg-white cursor-pointer"
        :class="{'h-10 w-10 md:w-14 md:h-14': small, 'h-20 w-20 md:w-40 md:h-40': !small, 'rounded-full border': rounded}"
        alt=""
        @click="showFullImg = !showFullImg"
    />

    <div v-if="showFullImg" class="h-screen z-[5000] overflow-y-auto select-none bg-gray-500 bg-opacity-35 w-screen fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center">
        <div class="fixed top-14 right-14 z-[5000]">
            <button class=" text-red-700 bg-white rounded-md p-4 py-2 text-xl" @click="showFullImg = !showFullImg">X</button>
        </div>
        <img :src="imageSrc" style="" class=" h-[95%] bg-white" alt="image alt">
    </div>

</template>
