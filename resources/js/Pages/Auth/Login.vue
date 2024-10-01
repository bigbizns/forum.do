<script setup lang="ts">
import {ref} from "vue";
import {Link, useForm} from "@inertiajs/vue3";
import openEye from '@/images/open-eye.png';
import closeEye from '@/images/close-eye.png';

const passwordToText = ref<boolean>(false);
const togglePasswordToText = () => {
    passwordToText.value = !passwordToText.value;
}

const form = useForm({
    username: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post(route('loginStore'), {onError: () => form.reset('password','remember')});
};
</script>

<template>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
                Login
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
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <input
                            v-model="form.password"
                            id="password"
                            class="w-full px-4 py-2 rounded-l-lg"
                            :type="passwordToText ? 'text': 'password'"
                        />
                        <img :src="passwordToText ? closeEye : openEye" alt="" class="w-4 mx-4 cursor-pointer" @click="togglePasswordToText">
                    </div>
                    <small class="text-red-600 font-semibold">{{ form.errors.password }}</small>
                    <small class="text-red-600 font-semibold">{{ form.errors.message }}</small>
                </div>
                <div class="flex items-center gap-2 mb-4">

                </div>
                <div class="flex justify-between items-center mb-5">
                    <div class="flex items-center gap-2">
                        <input v-model="form.remember" type="checkbox" id="rememberMe" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="rememberMe" class="text-gray-600">Remember me</label>
                    </div>

                    <div class="flex gap-2">
                        <p class="text-gray-600">Forgot password?</p>
                        <Link href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 font-medium transition-colors duration-300 ease-in-out">Reset</Link>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-8 rounded-lg hover:bg-blue-600 transition duration-300">
                        Log in
                    </button>
                </div>
            </form>
            <div class="mt-4 text-center">
                <p class="text-gray-600">
                     Don't have an account?
                    <Link :href="route('register')" class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">Register</Link>
                </p>
            </div>
        </div>
    </div>
</template>
