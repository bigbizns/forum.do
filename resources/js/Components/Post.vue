<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import user from '@/Images/user.png';

defineProps<{
    title: string,
    description: string,
    id: number,
    avatar: string,
    user_id: number
}>();
</script>

<template>
    <Link :href="route('post.show',{id: id})">
        <div class="flex bg-gray-800 shadow-xl cursor-pointer rounded flex-row p-3">
            <div>
                <Link :href="route('user.profile',{id: user_id})">
                    <img
                        :src="avatar ? `/storage/${avatar}`:user"
                        alt="" class="max-w-12 rounded-3xl shadow">
                </Link>
            </div>
            <div class="mx-5">
                <div class="text-white">
                    <h2 class="font-bold opacity-75">{{ title }}</h2>
                </div>
                <div class="text-gray-100">
                    <p class="opacity-40">{{ description }}</p>
                </div>
            </div>
        </div>
    </Link>
</template>
