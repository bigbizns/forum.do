<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {SubCategoryItemInterface} from "@/Types/SubCategoryItemInterface";
import Post from "@/Components/Post.vue";
import {Head} from "@inertiajs/vue3";

defineProps<{
    title: string,
    posts: SubCategoryItemInterface[]
}>();
</script>

<template>
    <Head :title="title"/>
    <Navigation/>
    <div class="mx-auto w-[90%] flex-grow mt-20 mb-16">
        <div class="bg-black/40 rounded-lg p-4 text-white shadow-lg">
            <div class="mb-4">
                <h2 class="text-15 font-bold">{{ title }}</h2>
            </div>
            <div class="flex flex-col gap-3">
                <template v-if="posts.length != 0">
                    <Post
                        v-for="post in posts"
                        :user_id="post.user_id"
                        :trade-action="post.tradeAction"
                        :description="post.description"
                        :id="post.id"
                        :avatar="post.avatar"
                        :title="post.title"
                        :created_at="post.created_at"/>
                </template>
                <template v-else>
                    No one yet posted
                </template>
            </div>
        </div>
    </div>
    <Footer/>
</template>
