<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const form = useForm({});
const formSubmited = ref<boolean>(false);

const submit = () => {
    form.post(route('account.sendVerifyEmail'), {onSuccess: () => formSubmited.value = true});
};
const verificationform = useForm({
    code: null,
});

const submitVerification = () => {
    verificationform.post(route('account.verifyEmailStore'))
}
</script>

<template>
    <section class="bg-black/40 p-6 rounded-lg shadow-md mb-8">
        <form @submit.prevent="submit">
            <h2 class="text-xl text-gray-300 font-semibold mb-4">Verify Email</h2>
            <div class="flex flex-col gap-4">
                <div>
                    <template v-if="!formSubmited">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            Verify Email
                        </button>
                    </template>
                    <template v-if="!formSubmited">
                        <p class="text-red-500 mt-2">
                            Please verify your email to complete the account setup.
                            Once verified, you will be able to use all account features.
                        </p>
                    </template>
                    <template v-else>
                        <form @submit.prevent="submitVerification" class="flex items-center space-x-3">
                            <input
                                v-model="verificationform.code"
                                type="text"
                                placeholder="Enter Verification Code"
                                class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                            >
                            <button
                                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                Verify
                            </button>
                        </form>
                        <small class="text-red-600 font-semibold">{{verificationform.errors.code}}</small>
                    </template>

                </div>
                <small class="text-green-500 font-semibold">{{ $page.props.flash.email_message }}</small>
            </div>
        </form>
    </section>
</template>

