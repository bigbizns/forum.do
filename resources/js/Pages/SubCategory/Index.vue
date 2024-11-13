<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {SubCategoryItemInterface} from "@/Types/SubCategoryItemInterface";
import Post from "@/Components/Post.vue";

defineProps<{
    title: string,
    posts: SubCategoryItemInterface[]
}>();
</script>

<template>
    <Navigation/>

    <div class="mx-auto w-[90%] flex-grow mt-20 mb-16 h-screen">
        <div class="bg-black/40 rounded-lg p-4 text-white shadow-lg">
            <div class="mb-4">
                <h2 class="text-15 font-bold">{{ title }}</h2>
            </div>
            <div class="flex flex-col gap-3">
                <Post
                    v-for="post in posts"
                    :user_id="post.user_id"
                    :trade-action="post.tradeAction"
                    :description="post.description"
                    :id="post.id"
                    avatar=""
                    :title="post.title"
                />
            </div>
        </div>
    </div>

    <Footer/>
</template>
