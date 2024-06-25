<script setup>
defineProps({
   status: {
      type: Boolean,
      default: false
   },
   color: {
        type: String,
        default: "green"
   }
})
</script>

<template>
   <div v-if="color == 'green'" class=" rounded-3xl w-20 h-10 cursor-pointer" :class="{ 'bg-green-500': status, 'bg-gray-300': !status }">
      <div class="w-10 h-10 shadow-md bg-white rounded-full" :class="{ 'float-right': status }">
      </div>
   </div>
   <div v-else class=" rounded-3xl w-20 h-10 cursor-pointer" :class="{ 'bg-blue-500': status, 'bg-gray-300': !status }">
      <div class="w-10 h-10 shadow-md bg-white rounded-full" :class="{ 'float-right': status }">
      </div>
   </div>
</template>
