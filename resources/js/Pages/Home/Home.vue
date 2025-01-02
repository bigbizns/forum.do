<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";
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
import {ref, watch} from "vue";
import debounce from 'lodash/debounce';
import axios from "axios";
import SearchModal from "@/Pages/Home/HomeComponents/SearchModal.vue";
import close from '@/Images/close.png';
import {PageNumbersInterface, PaginationInterface} from "@/Types/PaginationInterface";

const props = defineProps<{
    userData: UserInterface
    recentPosts: {
        data: PostInterface[],
        pagination: PaginationInterface,
        pageNumbers: PageNumbersInterface[],
    };
    categories: CategoryInterface[],
    subCategories: SubCategoryInterface[],
}>();

const form = useForm({
    search: ''
});
const searchPosts = ref<PostInterface[]>([]);
const searchMessage = ref<string>('');
const isLookingAtModal = ref<boolean>(false);

watch(() => form.search,
    debounce(() => {
        axios.get(route('searchBar', {search: form.search}))
            .then((res) => {
                if (res.data.length === 0 && form.search != '') {
                    searchMessage.value = 'Nothing Found';
                }
                if (res.data.length === 0 && form.search === '') {
                    searchMessage.value = '';
                }
                if (res.data.length !== 0 && form.search != '') {
                    searchMessage.value = '';
                }

                searchPosts.value = res.data
            })
            .finally(() => isLookingAtModal.value = true);
    }, 300));

const cancelSearch = () => {
    searchMessage.value = '';
    form.search = '';
    isLookingAtModal.value = false;
    searchPosts.value = [];
}
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <Head title="Home"/>
        <Navigation/>
        <template v-if="$page.props.auth.user && !props.userData.email_verified_at">
            <WarningEmailMessage/>
        </template>

        <div class="container mx-auto w-[90%] flex-grow mt-20 mb-16 h-auto">
            <div class="bg-gray-800 rounded-lg p-4 text-white shadow-lg">
                <div class="mb-4"><h2 class="text-15 font-bold">Search Forum</h2></div>
                <div>
                    <form class="relative">
                        <div class="flex">
                            <input
                                v-model="form.search"
                                type="text"
                                placeholder="Search..."
                                class="bg-gray-700 w-full p-1 pr-10 placeholder-opacity-25 text-opacity-75 placeholder-white text-white border border-gray-600 rounded focus:outline-none focus:border-blue-400"
                            />
                            <img
                                :src="close"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 w-5 cursor-pointer"
                                alt="clear"
                                @click="cancelSearch"
                            />
                        </div>
                        <template v-if="searchPosts.length != 0">
                            <div class="absolute left-0 right-0 mt-1">
                                <SearchModal :search-posts="searchPosts" @cancel="cancelSearch" :title="form.search"/>
                            </div>
                        </template>
                    </form>
                    <p class="mt-2 text-xl">{{ searchMessage }}</p>
                </div>
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
                <RecentPostPagination :pagination="recentPosts.pagination" :page-numbers="recentPosts.pageNumbers"/>
            </div>
        </div>
        <Footer/>
    </div>
</template>
