<script setup lang="ts">
import avatarUrl from '@/Images/user.png';
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    avatar: null,
});

const change = (e) => {
    form.avatar = e.target.files[0];
};

const submit = () => {
    form.post(route('account.avatarStore'));
};
</script>

<template>
    <section class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form @submit.prevent="submit">
            <h2 class="text-xl font-semibold mb-4">Update Avatar</h2>
            <div class="flex flex-col gap-4">
                <div v-if="$page.props.auth.user.avatar" class="flex items-center gap-5">
                    <img :src="`/storage/${$page.props.auth.user.avatar}`"
                         alt="User Avatar"
                         class="w-20 h-20 object-cover rounded-full shadow-2xl">
                    <input type="file" @input="change">
                </div>
                <div v-else class="flex items-center gap-5">
                    <img :src="avatarUrl" alt="User Avatar" class="w-20 h-20 object-cover rounded-full shadow-md">
                    <input type="file" @input="change">
                </div>
                <small class="text-red-600 font-semibold">{{ form.errors.avatar }}</small>
                <small class="text-green-500 font-semibold">{{ $page.props.flash.message }}</small>
                <div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Update Avatar
                    </button>
                </div>
            </div>
        </form>
    </section>
</template>
