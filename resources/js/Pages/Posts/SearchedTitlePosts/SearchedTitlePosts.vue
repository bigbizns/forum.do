<script setup lang="ts">

import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import Post from "@/Components/Post.vue";

defineProps<{
    posts: PostInterface[],
    title: string,
}>();
</script>

<template>
<Navigation/>
    <div class="my-20 h-screen flex justify-center">
        <div class="flex flex-col gap-3 bg-black/40 p-5 w-[80%] rounded shadow-2xl">
            <h1 class="text-white text-xl">All posts with: {{title}}</h1>
        <Post
            v-for="post in posts"
            :user_id="post.user_id"
            :trade-action="post.tradeAction"
            :description="post.description"
            :id="post.id"
            :avatar="post.avatar"
            :title="post.title"/>
        </div>
    </div>
    <Footer/>
</template>
