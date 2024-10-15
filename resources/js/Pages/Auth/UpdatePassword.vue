<script setup lang="ts">
import {computed, ref} from "vue";
import {Head, useForm} from "@inertiajs/vue3";
import openEye from '@/images/open-eye.png';
import closeEye from '@/images/close-eye.png';
import FormInputPassword from "@/Components/FormInputPassword.vue";

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

const path = window.location.pathname;
const recoveryLink = path.split('/').pop();

const submit = () => {
    form.post(route('update.password.store', {recoverUrl: recoveryLink}));
};
</script>

<template>
    <Head title="Recovery"/>
    <div class="h-screen w-full flex items-center justify-center">
        <div class="bg-black/40 rounded-lg shadow-lg w-full max-w-lg">
            <form @submit.prevent="submit" class="p-10">
                <h1 class="text-3xl font-bold text-white mb-6">
                    Update your password
                </h1>
                <FormInputPassword v-model="form.password" label="password" label-name="New Password" :error="form.errors.password"/>
                <FormInputPassword v-model="form.password_confirmation" label="password_confirmation" label-name="Confirm New Password"/>
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

