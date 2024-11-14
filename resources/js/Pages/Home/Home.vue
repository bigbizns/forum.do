<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import Footer from "@/Layouts/Footer.vue";
import Navigation from "@/Layouts/Navigation.vue";
import type {UserInterface} from "@/Types/UserInterface";
import Post from "@/Components/Post.vue";
import SubCategory from "@/Components/SubCategoryCard.vue";
import HomeTopicLinks from "@/Pages/Home/HomeComponents/HomeTopicLinks.vue";
import WarningEmailMessage from "@/Components/WarningEmailMessage.vue";
import RecentPostPagination from "@/Pages/Home/HomeComponents/RecentPostPagination.vue";
import {CategoryInterface} from "@/Types/CategoryInterface";
import {SubCategoryInterface} from "@/Types/SubCategoryInterface";

const props = defineProps<{
    userData: UserInterface
    recentPosts: {
        data: PostInterface[],
        pagination: PaginationInterface
    };
    categories: CategoryInterface[],
    subCategories: SubCategoryInterface[],
}>();
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <Head title="Home"/>
        <Navigation/>
        <template v-if="$page.props.auth.user && !props.userData.email_verified_at">
            <WarningEmailMessage/>
        </template>

        <div class="container mx-auto w-[90%] flex-grow mt-20 mb-16 h-auto">
            <!-- TODO: Finish the header section -->
            <div class="bg-gray-800 rounded-lg p-4 text-white shadow-lg">
                <div class="mb-4"><h2 class="text-15 font-bold">Search Forum</h2></div>
                <div>
                    <input
                        type="text"
                        placeholder="Search..."
                        class="bg-gray-700 w-full p-1 placeholder-opacity-25 text-opacity-75 placeholder-white text-white border border-gray-600 rounded focus:outline-none focus:border-blue-400"
                    />
                </div>
                <p class="text-sm text-white mt-2 font-bold text-center text-opacity-35">
                    Search your games: GTA, PUBG, WoW, COC, etc. Available 3000+ games. We support Xbox, PS, Steam,
                    YouTube, Instagram, currency exchange, and many more.
                </p>
            </div>
            <div class="bg-gray-900 rounded-lg mt-5">
                <HomeTopicLinks :categories="categories"/>
            </div>
            <div class="bg-gray-700 pt-2 mt-5">
                <div class="bg-black/40 flex flex-col gap-4 rounded-lg p-4 mt-2">
                    <h1 class="text-white text-xl">Sub-Categories</h1>
                    <SubCategory
                        v-for="sub in subCategories"
                        :id="sub.id"
                        :title="sub.title"
                        :slug="sub.slug"
                    />
                </div>
            </div>
            <div class="mt-10">
                <div class="bg-black/40 flex flex-col gap-4 rounded-lg p-4 mt-2">
                    <h1 class="text-white text-xl">Recent Posts</h1>
                    <Post
                        v-for="post in recentPosts.data"
                        :trade-action="post.tradeAction"
                        :key="post.title"
                        :avatar="post.avatar"
                        :title="post.title"
                        :id="post.id"
                        :description="post.description"
                        :user_id="post.user_id"/>
                </div>
            <RecentPostPagination :pagination="recentPosts.pagination"/>
        </div>
        </div>
        <Footer/>
    </div>
</template>
