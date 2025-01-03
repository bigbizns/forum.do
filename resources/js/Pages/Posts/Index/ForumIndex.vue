<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {Head, Link} from "@inertiajs/vue3";
import Post from "@/Components/Post.vue";
import {PageNumbersInterface, PaginationInterface} from "@/Types/PaginationInterface";
import {computed} from "vue";

const props = defineProps<{
    posts: {
        data: PostInterface[],
        pagination: PaginationInterface,
        pageNumbers: PageNumbersInterface[]
    };
}>();

const visiblePages = computed(() => {
    const totalPages = props.posts.pagination.last_page;
    const currentPage = props.posts.pagination.current_page;

    const startPage = Math.max(1, currentPage - 4);
    const endPage = Math.min(totalPages, startPage + 9);

    const pages = [];

    for (let page = startPage; page <= endPage; page++) {
        pages.push(page);
    }

    return pages;
});
</script>

<template>
    <Head title="All posts"/>
    <Navigation/>
    <div class="mt-20 container min-h-screen mx-auto p-6">
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
        <div class="flex items-center justify-center  mt-4">
            <Link
                :href="posts.pagination.prev_page_url"
                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-gray-800 rounded transition duration-150 hover:text-gray-700  dark:text-gray-400 dark:hover:text-white">
                Previous
            </Link>
            <Link
                v-for="page in visiblePages"
                :href="`?page=${page}`"
                :class="{
                'flex items-center justify-center px-4 h-10 leading-tight text-blue-500 transition duration-150': page == posts.pagination.current_page,
                'flex items-center justify-center px-4 h-10 leading-tight text-white hover:text-blue-500 transition duration-150': page != posts.pagination.current_page
            }"
            >
                {{ page }}
            </Link>
            <Link
                :href="posts.pagination.next_page_url"
                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-gray-800 rounded transition duration-150 hover:text-gray-700  dark:text-gray-400 dark:hover:text-white">
                Next
            </Link>
        </div>
         <p class="text-white text-sm">
        Page {{ posts.pagination.current_page }} of {{ posts.pagination.last_page }}
    </p>
    </div>
    <Footer/>
</template>
