<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, useForm} from "@inertiajs/vue3";
import Separator from "@/Components/Separator.vue";
import {EditRequestPostInterface} from "@/Types/adminDashUsersInterface";

const props = defineProps<{
    post: EditRequestPostInterface
}>();

const emit = defineEmits<{
    (e: 'cancel'): void;
}>();

const cancel = () => {
    emit('cancel');
};

const form = useForm({
    postId: props.post.post_id,
    title: props.post.title,
    description: props.post.description
});
const submit = () => {
    form.post(route('admin.dashboard.approve.edit.request'), {onSuccess: () => emit('cancel')});
};
</script>

<template>
    <Head title="Report Post"/>
    <div
        class="fixed z-10 inset-0 flex items-center justify-center bg-black/60 transition-opacity duration-300 ease-out"
        @click="cancel">
        <div class="z-30 bg-gray-800 p-8 rounded-lg shadow-lg transform w-[100vh]" @click.stop>
            <form @submit.prevent="submit">
                <div class="flex justify-between">
                    <div class="flex-1 mr-4">
                        <div class="text-white"><p>Original</p></div>
                        <Separator/>
                        <div class="mb-2 mt-5 text-white"><p>{{ post.originalTitle }}</p></div>
                        <div class=" text-white overflow-auto max-h-[500px] max-w-[400px]">
                            <p>{{ post.originalDescription }}</p>
                        </div>
                    </div>
                    <div class="flex-1 ml-4">
                        <div class="text-white"><p>Edited</p></div>
                        <Separator/>
                        <div class="mb-2 mt-5 text-white">
                            <p>{{ post.title }}</p>
                        </div>
                        <div class=" text-white overflow-auto max-h-[500px] max-w-[400px]"><p>{{ post.description }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 items-center mt-5">
                    <PrimaryButton text="Approve" type="Submit"/>
                    <button
                        class="bg-red-500 text-white font-semibold py-2 px-8 rounded-lg hover:bg-blue-600 transition duration-300"
                        @click="cancel">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
