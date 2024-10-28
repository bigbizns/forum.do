<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import user from '@/Images/user.png';
import {TradeActionEnum} from "@/Helpers/TradeActionEnum";
import {TextLengthEnum} from '@/Enums/TextLengthEnum';

defineProps<{
    title: string,
    description: string,
    tradeAction: string,
    id: string,
    avatar: string,
    user_id: number
}>();

const minimizeString = (text: string): string => {
    if (text.length > TextLengthEnum.HundredFifty) {
        return text.slice(0, TextLengthEnum.HundredFifty) + '...';
    } else {
        return text;
    }
};
</script>

<template>
    <Link :href="route('post.show', { id: id })">
        <div class="flex bg-gray-800 shadow-lg cursor-pointer rounded-lg overflow-hidden p-4 hover:bg-gray-700 transition duration-200">
            <div class="flex flex-col gap-2 justify-center items-center">
                <Link :href="route('user.profile', { id: user_id })">
                    <img
                        :src="avatar ? `/storage/${avatar}` : user"
                        alt=""
                        class="max-w-12 rounded-full border-2 bg-white border-gray-600 shadow-lg">
                </Link>
                <template v-if="tradeAction === TradeActionEnum.Selling">
                    <div class="bg-green-600 text-white rounded-full py-1 px-1 text-xs font-semibold">
                        {{ TradeActionEnum.Selling }}
                    </div>
                </template>
                <template v-else-if="tradeAction === TradeActionEnum.Buying">
                    <div class="bg-blue-600 text-white rounded-full py-1 px-1 text-xs font-semibold">
                        {{ TradeActionEnum.Buying }}
                    </div>
                </template>
            </div>
            <div class="mx-4 flex-1">
                <div class="text-white">
                    <h2 class="font-bold text-lg opacity-90">{{ title }}</h2>
                </div>
                <div class="text-gray-300 flex-grow flex items-center break-words">
                    <p class="opacity-70 overflow-hidden overflow-ellipsis break-all">{{ minimizeString(description) }}</p>
                </div>
            </div>
        </div>
    </Link>
</template>


