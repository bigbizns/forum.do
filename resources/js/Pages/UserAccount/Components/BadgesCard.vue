<script setup lang="ts">
import {BadgesEnum} from "@/Enums/BadgesEnum";
import verifiedEmail from "@/Images/verified_email.png";
import firstPost from '@/Images/firstPost.png';
import {BadgesInterface} from "@/Types/BadgesInterface";

defineProps<{
    badges: BadgesInterface[]
}>();
</script>

<template>
    <div class="max-w-5xl mx-auto mt-6 bg-black/40 p-6 rounded-lg shadow-md">
        <h3 class="text-gray-500 text-xl font-semibold mb-3">Badges</h3>
        <div class="flex gap-5 items-center">
            <template v-if="badges.length != 0" v-for="badge in badges">
                <div v-if="badge.type === BadgesEnum.EmailVerified">
                    <img :src="verifiedEmail" class="w-14" alt="verified email"/>
                </div>
                <div v-if="badge.type === BadgesEnum.FirstPost">
                    <img :src="firstPost" class="w-12" alt="first post"/>
                </div>
            </template>
            <template v-else>
                <p class="text-gray-300 leading-relaxed"> This user has no badges.</p>
            </template>
        </div>
    </div>
</template>
