<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import FormInput from "@/Components/FormInput.vue";
import FormInputPassword from "@/Components/FormInputPassword.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    username: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post(route('login.store'), {onError: () => form.reset('password', 'remember')});
};
</script>

<template>
    <Head title="Login"/>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-black/40 p-10 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-3xl font-bold text-center text-white mb-6">
                Login
            </h1>
            <form @submit.prevent="submit">
                <FormInput v-model="form.username" label="username" label-name="Username" type="text" :error="form.errors.username"/>
                <FormInputPassword v-model="form.password" label="password" label-name="Password" :error="form.errors.password"/>
                <small class="text-red-600 font-semibold">{{ form.errors.message }}</small>

                <div class="flex justify-between items-center mb-5">
                    <div class="flex items-center gap-2">
                        <input v-model="form.remember" type="checkbox" id="rememberMe" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="rememberMe" class="text-white">Remember me</label>
                    </div>

                    <div class="flex gap-2">
                        <p class="text-white">Forgot password?</p>
                        <Link :href="route('recover')" class="text-blue-500 hover:text-blue-700 font-medium transition-colors duration-300 ease-in-out">Reset</Link>
                    </div>
                </div>

                <div class="flex justify-center">
                   <PrimaryButton text="Log in" type="submit"/>
                </div>
            </form>
            <div class="mt-4 text-center">
                <p class="text-white">
                     Don't have an account?
                    <Link :href="route('register')" class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">Register</Link>
                </p>
            </div>
        </div>
    </div>
</template>
