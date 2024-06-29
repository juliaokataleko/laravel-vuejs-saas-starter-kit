<script setup>
import { useForm } from '@inertiajs/vue3';
import ImageView from '../ImageView.vue';


const props = defineProps({
    payment: {
        type: Object,
        default: () => ({}),
    },
    can_delete: {
        type: Boolean,
        default: () => (false),
    }
});

const clearImage = (id = null) => {

    if (confirm("Tem certeza?")) {
        deleteForm.id = id
        deleteForm.delete(route("files.destroy", id));
    }

};

const deleteForm = useForm({
    id: "",
});

</script>

<template>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mt-3">
            <div
                v-for="(item, index) in subscription?.media"
                :key="index"
                class="flex flex-col items-center justify-center space-y-2"
            >
    
                <ImageView :image-src="item.original_url" :small="false" />

                <button v-if="can_delete"
                    @click="clearImage(item.id)"
                    class="border-2 border-red-500 rounded-lg p-1 px-5"
                >
                    X
                </button>
            </div>
        </div>
    </div>
</template>
