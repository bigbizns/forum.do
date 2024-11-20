<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import UserDashBoardNav from "@/Components/UserDashBoardNav.vue";
import {UserDashboardPostInterface} from "@/Types/UserDashboardPostInterface";
import Edit from "@/Images/edit.png";
import deletePost from "@/Images/x-button.png";
import {TradeActionEnum} from "@/Helpers/TradeActionEnum";

defineProps<{
    posts: UserDashboardPostInterface[]
}>();
</script>

<template>
    <Head title="Dashboard Your Post"/>
    <div class="min-h-full">
        <UserDashBoardNav/>

        <header class="bg-black/40 shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
                <!--TODO: NEXT TO DASHBOARD WE CAN SHOW FLASH MESSAGES-->
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <div v-for="post in posts" :key="post.id" class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded shadow-xl">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <div class="flex gap-3 items-center">
                                    <Link :href="route('post.show', { id: post.id })" class="text-sm/6 font-semibold text-white duration-300 transition hover:text-blue-500">{{ post.title }}</Link>
                                    <template v-if="post.pinned === 1">
                                        <p class="bg-blue-500 text-white rounded-full px-3 py-1 text-xs font-semibold">Pinned</p>
                                    </template>
                                    <template v-if="post.tradeAction">
                                        <template v-if="post.tradeAction === TradeActionEnum.Selling">
                                            <div
                                                class="bg-green-500 text-white rounded-full px-3 py-1 text-xs font-semibold">
                                                {{ post.tradeAction }}
                                            </div>
                                        </template>
                                        <template v-else>
                                            <div
                                                class="bg-blue-500 text-white rounded-full px-3 py-1 text-xs font-semibold">
                                                {{ post.tradeAction }}
                                            </div>
                                        </template>
                                    </template>
                                </div>
                                <p class="mt-1 truncate text-xs/5 text-white">{{ post.description  }}</p>
                                <div class="flex items-center gap-4">
                                    <p class="text-sm text-white">Views: <b>{{ post.views }}</b></p>
                                    <p class="text-sm text-white">Likes: <b>{{ post.likes }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <div class="flex gap-3">
                                    <img :src="Edit" class="w-6 cursor-pointer" alt="edit"/>
                                    <img :src="deletePost" class="w-6 cursor-pointer" alt="delete"/>
                                </div>
                        </div>
                    </div>
            </div>
        </main>
    </div>
</template>
