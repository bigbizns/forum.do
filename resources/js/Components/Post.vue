<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import user from '@/Images/user.png';
import {TradeActionEnum} from "@/Helpers/TradeActionEnum";

defineProps<{
    title: string,
    description: string,
    tradeAction: string,
    id: number,
    avatar: string,
    user_id: number
}>();
</script>

<template>
    <Link :href="route('post.show', { id: id })">
        <div class="flex bg-gray-800 shadow-lg cursor-pointer rounded-lg overflow-hidden p-4 hover:bg-gray-700 transition duration-200">
            <div class="flex items-center">
                <Link :href="route('user.profile', { id: user_id })">
                    <img
                        :src="avatar ? `/storage/${avatar}` : user"
                        alt=""
                        class="max-w-12 rounded-full border-2 bg-white border-gray-600 shadow-lg">
                </Link>
                <template v-if="tradeAction === TradeActionEnum.Selling">
                    <div class="bg-green-600 text-white rounded-full px-3 py-1 text-xs font-semibold ml-3">
                        {{ TradeActionEnum.Selling }}
                    </div>
                </template>
                <template v-else-if="tradeAction === TradeActionEnum.Buying">
                    <div class="bg-blue-600 text-white rounded-full px-3 py-1 text-xs font-semibold ml-3">
                        {{ TradeActionEnum.Buying }}
                    </div>
                </template>
            </div>
            <div class="mx-4 flex-1">
                <div class="text-white">
                    <h2 class="font-bold text-lg opacity-90">{{ title }}</h2>
                </div>
                <div class="text-gray-300">
                    <p class="opacity-70">{{ description }}</p>
                </div>
            </div>
        </div>
    </Link>
</template>


