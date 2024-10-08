<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";

const form = useForm({
    code: null,
});

const submit = () => {
    form.post(route('verifyEmailStore'));
};
</script>

<template>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-black/40 rounded-lg shadow-lg w-full max-w-lg">
            <form @submit.prevent="submit" class="p-10">
                <h1 class="text-3xl font-bold text-white mb-6">
                    Email Verification
                </h1>
                <div class="mb-4">
                    <label for="verificationKey" class="block text-white text-sm font-medium mb-1">Verification Code</label>
                    <div class="flex items-center border border-gray-300 bg-white rounded-lg">
                        <input v-model="form.code" id="verificationKey" type="text" class="w-full px-4 py-2 rounded-l-lg" placeholder="Enter your code" />
                    </div>
                        <small class="text-red-600 font-semibold">{{form.errors.code}}</small>
                </div>
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-8 rounded-lg hover:bg-blue-600 transition duration-300">
                        Verify Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
