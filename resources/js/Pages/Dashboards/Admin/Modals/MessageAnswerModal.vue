<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {MessagesInterface} from "@/Types/adminDashUsersInterface";
import Separator from "@/Components/Separator.vue";

defineProps<{
    message: MessagesInterface;
}>();

const emit = defineEmits<{
    (e: 'cancel'): void;
}>();

const cancel = () => {
    emit('cancel');
};

const form = useForm({
});
const submit = () => {
};
</script>

<template>
    <Head title="Delete post"/>
    <div
        class="fixed z-10 inset-0 flex items-center justify-center bg-black/60 transition-opacity duration-300 ease-out"
        @click="cancel">
        <div class="z-30 bg-gray-800 p-8 rounded-lg shadow-lg transform w-[100vh]" @click.stop>
            <form @submit.prevent="submit">
                <div class="flex flex-col mb-1 text-s font-semibold text-white">
                    <h1 class="mb-2">{{ message.email }}</h1>
                    <h1>{{ message.topic }}</h1>
                </div>
                <Separator/>
                <div class="flex justify-between items-center mt-5 text-white">
                    {{ message.message }}
                </div>
                <div class="mt-5">
                <textarea cols="95" rows="10" class="rounded p-3" placeholder="Answer Here"></textarea>
                </div>
                <div class="flex mt-6 gap-4">
                    <PrimaryButton text="Submit" type="submit"/>
                </div>
            </form>
        </div>
    </div>
</template>
