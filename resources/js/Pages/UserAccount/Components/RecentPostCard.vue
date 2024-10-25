<script setup lang="ts">
import {UsersPostsInterface} from "@/Types/UserInterface";
import {Link} from "@inertiajs/vue3";
import {getUsDate} from "@/Helpers/getUsDate";

defineProps<{
    userPosts: UsersPostsInterface[]
}>();

const minimizeString = (text: string): string => {
    return text.slice(0, 100) + '...';
};
</script>

<template>
    <template v-if="userPosts.length !== 0">
        <div v-for="post in userPosts" class="bg-black/40 p-4 rounded-lg shadow-sm cursor-pointer transition duration-200 hover:bg-black/20">
            <Link :href="route('post.show',{ id:post.id })">
                <h4 class="text-lg text-gray-300 font-medium">{{ post.title }}</h4>
                <p class="mt-2 text-gray-300 break-words">{{ minimizeString(post.description) }}</p>
                <p class="text-sm mt-1 text-gray-500">{{ getUsDate(post.created_at) }}</p>
            </Link>
        </div>
    </template>
    <template v-else>
        <p class="mt-2 text-gray-300">This user hasn't posted anything yet.</p>
    </template>
</template>
