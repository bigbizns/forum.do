<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps<{
    commentId: string,
    comment: string,
}>();

const emit = defineEmits<{
    (e: 'cancel'): void;
}>();

const cancel = () => {
    emit('cancel');
};

const form = useForm({
    commentId: props.commentId,
});

const submit = () =>{
    form.post(route('post.comment.delete', {commentId: form.commentId}), {onSuccess: () => emit('cancel')});
};
</script>

<template>
    <div
        class="fixed z-10 inset-0 flex items-center justify-center bg-black/60 transition-opacity duration-300 ease-out"
        @click="cancel">
        <div class="z-30 bg-gray-800 p-8 rounded-lg shadow-lg transform w-[100vh]" @click.stop>
            <form @submit.prevent="submit">
                <div class="flex justify-between items-center mb-4 text-white">
                </div>
                <div class="mb-4">
                    <p class="text-white font-semibold">Are you sure you want to delete this comment ?</p>
                    <p class="text-white"> {{comment}} </p>
                    <small class="text-red-600 font-semibold">{{ form.errors.commentId }}</small>
                </div>

                <div class="flex mt-6 gap-4">
                    <PrimaryButton text="Delete" type="submit"/>
                    <button @click="cancel"
                            class="inline-flex items-center justify-center px-6 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
