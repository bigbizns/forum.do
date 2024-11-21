<script setup lang="ts">
import type {UserInterface} from "@/Types/UserInterface";

defineProps<{
    userData: UserInterface
}>();
</script>

<template>
    <div class="flex flex-col gap-4 text-gray-300">
        <div class="flex items-center">
            <p>Joined: <span class="font-semibold text-gray-100">{{ userData.created_at }}</span></p>
        </div>
        <div class="flex items-center">
            <p>Balance: <span class="font-semibold text-gray-100">{{ $page.props.auth.user.balance.toFixed(2) }} $</span></p>
        </div>
        <div class="flex items-center">
            <p>Points: <span class="font-semibold text-gray-100">{{ userData.points ?? '0' }}</span></p>
        </div>
        <div class="flex items-center">
            <p>Posts: <span class="font-semibold text-gray-100">0</span></p>
        </div>
        <div class="flex items-center">
            <p>Comments: <span class="font-semibold text-gray-100">0</span></p>
        </div>
        <div class="flex items-center">
            <p>Likes: <span class="font-semibold text-gray-100">0</span></p>
        </div>
    </div>
</template>
