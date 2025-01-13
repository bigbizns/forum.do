<script setup lang="ts">
import ActivityCard from "@/Pages/UserAccount/Components/ActivityCard.vue";
import {UserRecentActivityInterface} from "@/Types/UserInterface";

defineProps<{
    userActivity: UserRecentActivityInterface[]
}>();
</script>

<template>
    <div class="max-w-5xl mx-auto mt-6 bg-black/40 p-6 rounded-lg shadow-md">
        <h3 class="text-xl text-gray-500 font-semibold mb-3">Latest Activity</h3>
        <div class="space-y-4">
            <template v-if="userActivity.length === 0">
                <p class="text-gray-300 leading-relaxed"> No Recent Activity.</p>
            </template>
            <template v-else>
                <ActivityCard :user-activity="userActivity"/>
            </template>
        </div>
    </div>
</template>
