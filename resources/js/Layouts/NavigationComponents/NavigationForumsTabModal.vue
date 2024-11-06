<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="flex flex-col text-white absolute top-14 right-50 bg-black/60 w-40 rounded-lg shadow-lg p-2 border border-gray-600 z-50">
        <Link :href="route('forum')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">All Forum posts</Link>
        <Link :href="route('post.create')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Create Post</Link>
    </div>
</template>
