<script lang="ts" setup>
import {UserInterface} from "@/Types/UserInterface";

const props = defineProps<{
    userData: UserInterface
}>();
</script>

<template>
    <div class="max-w-5xl mx-auto mt-6 grid grid-cols-4 gap-4">
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">{{ props.userData.points }}</p>
            <p class="text-gray-500">Points</p>
        </div>
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">0</p>
            <p class="text-gray-500">Posts</p>
        </div>
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">0</p>
            <p class="text-gray-500">Comments</p>
        </div>
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">0</p>
            <p class="text-gray-500">Likes</p>
        </div>
    </div>
</template>
