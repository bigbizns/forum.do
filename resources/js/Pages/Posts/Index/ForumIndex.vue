<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {Head, Link} from "@inertiajs/vue3";
import Post from "@/Components/Post.vue";

const props = defineProps<{
    posts: {
        data: PostInterface[],
        pagination: PaginationInterface
    };
}>();
</script>

<template>
    <Head title="All posts"/>
    <Navigation/>
    <div class="mt-20 container h-screen mx-auto p-6">
        <div class="bg-black/40 flex flex-col gap-4 rounded-lg p-4 mt-2">
            <h1 class="text-3xl font-bold text-white mb-6">All Forum Posts</h1>
            <Post
                v-for="post in posts.data"
                :trade-action="post.tradeAction"
                :key="post.title"
                :avatar="post.avatar"
                :title="post.title"
                :id="post.id"
                :description="post.description"
                :user_id="post.user_id"/>
        </div>
        <div class="flex items-center justify-end gap-5 mt-4">
            <Link
                preserve-scroll
                v-if="props.posts.pagination.prev_page_url"
                :href="props.posts.pagination.prev_page_url"
                class="text-white px-4 py-2 bg-gray-800 rounded transition duration-200 hover:bg-gray-500">
                Previous
            </Link>
            <Link
                preserve-scroll
                v-if="props.posts.pagination.next_page_url"
                :href="props.posts.pagination.next_page_url"
                class="text-white px-4 py-2 bg-gray-800 rounded transition duration-200 hover:bg-gray-500">
                Next
            </Link>
            <p class="text-white text-sm">
                Page {{ props.posts.pagination.current_page }} of {{ props.posts.pagination.last_page }}
            </p>
        </div>
    </div>
    <Footer/>
</template>
