<script setup lang="ts">
import {computed, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import openEye from '@/images/open-eye.png';
import closeEye from '@/images/close-eye.png';

const passwordToText = ref<boolean>(false);
const confirmPasswordToText = ref<boolean>(false);

const togglePasswordToText = () => {
    passwordToText.value = !passwordToText.value;
}

const toggleConfirmPasswordToText = () => {
    confirmPasswordToText.value = !confirmPasswordToText.value;
}

const passwordEyeIcon = computed(() => {
    return passwordToText.value ? closeEye : openEye;
});

const confirmPasswordEyeIcon = computed(() => {
    return confirmPasswordToText.value ? closeEye : openEye;
})

const form = useForm({
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post('');
};
</script>

<template>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-black/40 rounded-lg shadow-lg w-full max-w-lg">
            <form @submit.prevent="submit" class="p-10">
                <h1 class="text-3xl font-bold text-white mb-6">
                    Update your password
                </h1>
                <div class="mb-4">
                    <label for="password" class="block text-white text-sm font-medium mb-1">New Password</label>
                    <div class="flex items-center border border-gray-300 bg-white rounded-lg">
                        <input
                            v-model="form.password"
                            id="password"
                            class="w-full px-4 py-2 rounded-l-lg"
                            :type="passwordToText ? 'text': 'password'"
                        />
                        <img :src="passwordEyeIcon" alt="" class="w-4 mx-4 cursor-pointer"
                             @click="togglePasswordToText">
                    </div>
                    <small class="text-red-500 font-semibold">{{ form.errors.password }}</small>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-white text-sm font-medium mb-1">Confirm New
                        Password</label>
                    <div class="flex items-center border border-gray-300 bg-white rounded-lg">
                        <input
                            v-model="form.password_confirmation"
                            id="password_confirmation"
                            class="w-full px-4 py-2 rounded-l-lg"
                            :type="confirmPasswordToText ? 'text': 'password'"
                        />
                        <img :src="confirmPasswordEyeIcon" alt="" class="w-4 mx-4 cursor-pointer"
                             @click="toggleConfirmPasswordToText">
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-8 rounded-lg hover:bg-blue-600 transition duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

