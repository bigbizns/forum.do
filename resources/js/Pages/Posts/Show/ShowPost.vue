<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import Separator from "@/Components/Separator.vue";
import {getUsDate} from "@/Helpers/getUsDate";
import {computed} from "vue";
import {Link,Head} from "@inertiajs/vue3";
import {TradeActionEnum} from "@/Helpers/TradeActionEnum";

const props = defineProps<{
    post: PostInterface
}>();

const formattedDate = computed(() => {
    return getUsDate(props.post.createdAt);
});
</script>

<template>
    <Head :title="post.title"/>
    <Navigation/>
    <div class="h-screen">
        <div class="container mx-auto mt-20 p-6 bg-black/40 shadow-md rounded-lg">
            <div class="pb-4 flex items-center">
                <h1 class="text-2xl font-bold text-white mr-4">{{ post.title }}</h1>
                <template v-if="post.tradeAction === TradeActionEnum.Selling">
                    <div class="bg-green-600 text-white rounded-full px-3 py-1 text-xs font-semibold">
                        {{ TradeActionEnum.Selling }}
                    </div>
                </template>
                <template v-else-if="post.tradeAction === TradeActionEnum.Buying">
                    <div class="bg-blue-600 text-white rounded-full px-3 py-1 text-xs font-semibold">
                        {{ TradeActionEnum.Buying }}
                    </div>
                </template>
            </div>
            <p class="text-sm text-gray-400">Posted by <b class="text-white transition duration-300 hover:text-blue-500">
                <Link :href="route('user.profile',{id: post.author.id})">{{ post.author.username }}</Link>
            </b> on {{ formattedDate }}
            </p>
            <div class="mb-6">
                <Separator/>
            </div>
            <div class="text-white leading-relaxed mb-6">
                <p>
                    {{ post.description }}
                </p>
            </div>

            <div class="flex justify-between items-center text-white text-sm">
                <span>Views: 0</span>
                <span>Replies: 0</span>
            </div>
        </div>
    </div>
    <Footer/>
</template>


