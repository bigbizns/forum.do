<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps<{
    id: string,
    title: string,
    description: string
}>();

const emit = defineEmits<{
    (e: 'cancel'): void;
}>();

const form = useForm({
    originalTitle: props.title,
    originalDescription: props.description,
});

const cancel = () => {
    emit('cancel');
};

const submit = () => {
    form.post(route('post.delete', {postId: props.id}), {onSuccess: () => emit('cancel')});
};
</script>

<template>
    <Head title="Delete post"/>
    <div
        class="fixed z-10 inset-0 flex items-center justify-center bg-black/60 transition-opacity duration-300 ease-out"
        @click="cancel">
        <div class="z-30 bg-gray-800 p-8 rounded-lg shadow-lg transform w-[100vh]" @click.stop>
            <form @submit.prevent="submit">
                <div class="flex justify-between items-center mb-4 text-s font-semibold text-white">
                    {{ title }}
                </div>
                <div class="flex justify-between items-center mb-4 text-white">
                    Are you sure you want delete this post ?
                </div>
                <div class="flex mt-6 gap-4">
                    <PrimaryButton text="Yes" type="submit"/>
                    <button @click="cancel"
                            class="inline-flex items-center justify-center px-6 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        No
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>


