<script setup lang="ts">
import {UserRecentActivityInterface} from "@/Types/UserInterface";
import {Link} from "@inertiajs/vue3";
import {getUsDate} from "@/Helpers/getUsDate";
import {UserAccountEnum} from "@/Enums/UserAccountEnum";

defineProps<{
    userActivity: UserRecentActivityInterface[],
}>();

const actionText = (action: string): string => {
    return action === UserAccountEnum.Posted ? '' : 'on';
};
</script>

<template>
    <div v-for="activity in userActivity" class="bg-black/40 p-4 rounded-lg shadow-sm cursor-pointer transition duration-200 hover:bg-black/20">
        <Link :href="route('post.show',{ id: activity.post_id })">
            <div class="font-medium text-gray-300">{{ activity.action }} {{ actionText(activity.action) }}  {{ activity.postTitle }}</div>
            <div class="font-medium text-gray-300">{{ activity.comment }}</div>
            <p class="text-sm text-gray-500"> Date: {{ getUsDate(activity.created_at) }}</p>
        </Link>
    </div>
</template>
