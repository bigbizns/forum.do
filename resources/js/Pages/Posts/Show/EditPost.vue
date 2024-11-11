<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps<{
    id: string,
    title: string,
    description: string,

}>();

const emit = defineEmits<{
    (e: 'cancel'): void;
}>();

const form = useForm({
    title: props.title,
    description: props.description
});

const cancel = () => {
    emit('cancel');
};

const submit = () => {
    form.post(route('post.edit', {postId: props.id}), {onSuccess: () => emit('cancel')});
};
</script>

<template>
    <div
        class="fixed z-10 inset-0 flex items-center justify-center bg-black/60 transition-opacity duration-300 ease-out"
        @click="cancel">
        <div class="z-30 bg-gray-800 p-8 rounded-lg shadow-lg transform w-[100vh]" @click.stop>
            <form @submit.prevent="submit">
                <div class="flex justify-between items-center mb-4 text-white">
                    Edit Your Post
                </div>
                <div class="mb-4">
                    <input v-model="form.title" type="text" placeholder="Edit Title" class="mt-2 block w-full p-3 bg-gray-700 border border-gray-600 rounded-md shadow-sm text-gray-300 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out">
                    <small class="text-red-600 font-semibold">{{ form.errors.title }}</small>
                </div>
                <div class="mb-4">
                    <textarea
                        v-model="form.description"
                        rows="5"
                        id="title"
                        class="mt-2 block w-full p-3 bg-gray-700 border border-gray-600 rounded-md shadow-sm text-gray-300 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out"
                        placeholder="Edit Description"
                    >{{ form.description }}</textarea>
                    <small class="text-red-600 font-semibold">{{ form.errors.description }}</small>
                </div>

                <div class="flex mt-6 gap-4">
                    <PrimaryButton text="Submit" type="submit"/>
                    <button @click="cancel"
                            class="inline-flex items-center justify-center px-6 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>


