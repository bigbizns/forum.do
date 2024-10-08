<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";

const form=useForm({});

const submit = () => {
    form.post(route('account.sendVerifyEmail'));
};
</script>

<template>
    <section class="bg-black/40 p-6 rounded-lg shadow-md mb-8">
        <form @submit.prevent="submit">
            <h2 class="text-xl text-gray-300 font-semibold mb-4">Verify Email</h2>
            <div class="flex flex-col gap-4">
                <div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Verify Email
                    </button>
                    <p class="text-red-500 mt-2">
                        Please verify your email to complete the account setup.
                        Once verified, you will be able to use all account features.
                    </p>
                </div>
                <small class="text-green-500 font-semibold">{{ $page.props.flash.email_message }}</small>
            </div>
        </form>
    </section>
</template>

