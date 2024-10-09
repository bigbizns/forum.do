<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import FormInputPassword from "@/Components/FormInputPassword.vue";

const form = useForm({
    current_password: null,
    new_password: null,
    new_password_confirmation: null
});

const submit = () => {
    form.post(route('account.update.password'), {
        preserveScroll: true,
        onSuccess: () => form.reset('new_password', 'new_password_confirmation', 'current_password'),
        onError: () => form.reset('current_password')
    });
};
</script>

<template>
    <section class="bg-black/40 p-6 rounded-lg shadow-md">
        <h2 class="text-xl text-gray-300 font-semibold mb-4">Change Password</h2>
        <form @submit.prevent="submit" class="space-y-4">
            <div>
               <FormInputPassword v-model="form.current_password" label="current_password" label-name="Current password" :error="form.errors.current_password ?? ''"/>
            </div>

            <div class="flex gap-6">
                <div class="w-1/2">
                    <FormInputPassword v-model="form.new_password" label="new_password" label-name="New password" :error="form.errors.new_password ?? ''"/>
                </div>
                <div class="w-1/2">
                    <FormInputPassword v-model="form.new_password_confirmation" label="password_confirmation" label-name="Confirm password" :error="form.errors.new_password_confirmation ?? ''"/>
                </div>
            </div>
            <small class="text-green-500 font-semibold">{{ $page.props.flash.updatedPassword_message }}</small>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">Update Password</button>
            </div>
        </form>
    </section>
</template>
