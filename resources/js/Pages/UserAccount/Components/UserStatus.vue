<script lang="ts" setup>
import {UserInterface, UserStatsInterface} from "@/Types/UserInterface";

defineProps<{
    userData: UserInterface,
    userStats: UserStatsInterface,
}>();
</script>

<template>
    <div class="max-w-5xl mx-auto mt-6 grid grid-cols-4 gap-4">
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">{{ userData.points ?? '0' }}</p>
            <p class="text-gray-500">Points</p>
        </div>
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">{{ userStats.postCount ?? '0' }}</p>
            <p class="text-gray-500">Posts</p>
        </div>
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">{{ userStats.commentCount ?? '0' }}</p>
            <p class="text-gray-500">Comments</p>
        </div>
        <div class="bg-black/40 p-4 rounded-lg shadow-md text-center">
            <p class="text-2xl text-gray-300 font-bold">{{ userStats.likes ?? '0' }}</p>
            <p class="text-gray-500">Likes</p>
        </div>
    </div>
</template>
