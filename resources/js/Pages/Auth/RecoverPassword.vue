<script lang="ts" setup>
import {Link, useForm} from "@inertiajs/vue3";

const form = useForm({
    email: null
});

const submit = () => {
    form.post(route('recoverStore'));
};
</script>

<template>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg">
            <Link :href="route('login')" class="relative top-3 left-6 transition duration-300 hover:text-blue-500">
                &#8592;
            </Link>
            <form @submit.prevent="submit" class="p-10">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">
                    Reset your password
                </h1>
                <p class="text-sm text-gray-800 mb-3"> Enter your email address and we’ll send you a link to reset your
                    password</p>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                    <input
                        v-model="form.email"
                        id="email"
                        type="text"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{'border-red-600':form.errors.email}"
                    />
                    <small class="text-red-600 font-semibold">{{ form.errors.email }}</small>
                    <small class="text-red-600 font-semibold">{{ $page.props.errors.message }}</small>
                </div>
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-8 rounded-lg hover:bg-blue-600 transition duration-300">
                        Recover
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
