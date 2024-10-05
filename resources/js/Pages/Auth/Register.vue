<script setup lang="ts">
import {Link, useForm} from "@inertiajs/vue3";
import FormInput from "@/Components/FormInput.vue";
import FormInputPassword from "@/Components/FormInputPassword.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    username: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post(route('registerStore'), {onError: () => form.reset('password', 'password_confirmation')})
};
</script>

<template>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-black/40 p-10 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-3xl font-bold text-center text-white mb-6">
                Sign Up
            </h1>
            <form @submit.prevent="submit">
                <FormInput v-model="form.username" label="username" label-name="Username" type="text" :error="form.errors.username"/>
                <FormInput v-model="form.email" label="email" label-name="Email" type="email" :error="form.errors.email"/>
                <FormInputPassword  v-model="form.password" label="password" label-name="Password" :error="form.errors.password"/>
                <FormInputPassword  v-model="form.password_confirmation" label="password_confirmation" label-name="Confirm Password" :error="form.errors.password_confirmation"/>
                <div class="flex justify-center">
                  <PrimaryButton text="Sign up" type="submit"/>
                </div>
                <div class="mt-4 text-center">
                    <p class="text-white">
                        Already have an account?
                        <Link :href="route('login')" class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">Login</Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

