<script setup lang="ts">
import {Link, useForm} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import openEye from '@/images/open-eye.png';
import closeEye from '@/images/close-eye.png';

const passwordToText = ref<boolean>(false);
const confirmPasswordToText = ref<boolean>(false);

const togglePasswordToText = () => {
    passwordToText.value = !passwordToText.value;
}

const toggleConfirmPasswordToText = () => {
    confirmPasswordToText.value = !confirmPasswordToText.value
};

const form = useForm({
    username: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post(route('registerStore'), {onError: () => form.reset('password', 'password_confirmation')})
};

const passwordEyeIcon = computed(() => {
    return passwordToText.value ? closeEye : openEye;
});

const confirmPasswordEyeIcon = computed(() => {
    return confirmPasswordToText.value ? closeEye : openEye;
});

</script>

<template>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
                Sign Up
            </h1>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                    <input
                        v-model="form.username"
                        id="username"
                        type="text"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <small class="text-red-600 font-semibold">{{ form.errors.username }}</small>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                    <input
                        v-model="form.email"
                        id="email"
                        type="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <small class="text-red-600 font-semibold">{{ form.errors.email }}</small>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <input
                            v-model="form.password"
                            id="password"
                            class="w-full px-4 py-2 rounded-l-lg"
                            :type="passwordToText ? 'text': 'password'"
                        />
                        <img :src="passwordEyeIcon" alt="" class="w-4 mx-4 cursor-pointer" @click="togglePasswordToText">
                    </div>
                    <small class="text-red-600 font-semibold">{{ form.errors.password }}</small>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-1">Confirm Password</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <input
                            v-model="form.password_confirmation"
                            id="password_confirmation"
                            class="w-full px-4 py-2 rounded-l-lg"
                            :type="confirmPasswordToText ? 'text': 'password'"
                        />
                        <img :src="confirmPasswordEyeIcon" alt="" class="w-4 mx-4 cursor-pointer" @click="toggleConfirmPasswordToText">
                    </div>
                    <small class="text-red-600 font-semibold">{{ form.errors.confirmPassword }}</small>
                </div>

                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-8 rounded-lg hover:bg-blue-600 transition duration-300"
                    >
                        Sign up
                    </button>
                </div>
                <div class="mt-4 text-center">
                    <p class="text-gray-600">
                        Already have an account?
                        <Link :href="route('login')" class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">Login</Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

