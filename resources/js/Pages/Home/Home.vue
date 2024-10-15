<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import Footer from "@/Layouts/Footer.vue";
import Navigation from "@/Layouts/Navigation.vue";
import type {UserInterface} from "@/Types/UserInterface";
import Post from "@/Components/Post.vue";

const props = defineProps<{
    userData: UserInterface
    recentPosts: PostInterface[];
}>();
</script>

<template>
    <Head title="Home"/>
    <Navigation/>
    <template v-if="$page.props.auth.user && !props.userData.email_verified_at">
        <div class="fixed top-12 w-full z-50 bg-yellow-400 flex justify-center items-center py-3 shadow-lg rounded-md">
            <div class="flex items-center text-gray-900 space-x-2">
                <span class="font-bold">⚠️ Email not verified!</span>
                <span class="text-sm">Please go to</span>
                <Link :href="route('account.settings')" class="text-blue-600 font-semibold text-sm transition duration-300 hover:text-blue-500">Settings</Link>
                <span class="text-sm">to verify your email.</span>
            </div>
        </div>
    </template>
    <div class="container mx-auto w-[90%] mt-20 h-screen">
        <!-- TODO: Finish the header section -->
        <div class="bg-gray-800 rounded-lg p-4 text-white shadow-lg">
            <div class="mb-4">
                <h2 class="text-15 font-bold">Search Forum</h2>
            </div>
            <div>
                <input type="text" placeholder="minecraft accounts" class="bg-gray-700 w-full p-1 placeholder-opacity-25 text-opacity-75 placeholder-white text-white border border-gray-600 rounded focus:outline-none focus:border-blue-400"
                />
            </div>
            <p class="text-sm text-white mt-2 font-bold text-center text-opacity-35">
                Search your games: GTA, PUBG, WoW, COC, etc. Available 3000+ games. We support Xbox, PS, Steam, YouTube, Instagram, currency exchange, and many more.
            </p>
        </div>
        <!-- TODO: Think about the topics-->
        <div class="bg-gray-900 mt-5 rounded-lg">
            <div class="flex items-center rounded-lg">
                <a href="" class="px-8 py-4 text-opacity text-white rounded text-gray">Gaming Marketplace</a>
                <a href="" class="px-8 py-4 text-opacity text-white rounded text-gray">Discussion Forum</a>
                <a href="" class="px-8 py-4 text-opacity text-white rounded text-gray hover">Other Marketplace</a>
            </div>
        </div>
        <!-- TODO: Finish the forum section-->
        <!--TODO: Replace with UI POST-->
        <div class="bg-gray-700 pt-2">
            <div class="bg-gray-800 rounded-lg">
                <div class="flex flex-row p-3">
                    <div>
                        <Link :href="route('user.profile',{id:1})">
                        <img src="https://imageio.forbes.com/specials-images/imageserve/6170e01f8d7639b95a7f2eeb/Sotheby-s-NFT-Natively-Digital-1-2-sale-Bored-Ape-Yacht-Club--8817-by-Yuga-Labs/0x0.png?format=png&width=960" alt="" class="max-w-12">
                        </Link>
                    </div>
                    <div class="mx-5">
                        <div class="text-white">
                            <h2 class="font-bold opacity-75">Selling Minecraft Account</h2>
                        </div>
                        <div class="text-gray-100">
                            <p class="opacity-40">saaar please buy my account</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row p-3">
                    <div>
                        <img src="https://gibbonsgazette.org/wp-content/uploads/2022/04/43YAWLITTZJLZIQTCP2JSS4KSM.jpg" alt="" class="max-w-12">
                    </div>
                    <div class="mx-5">
                        <div class="text-white">
                            <h2 class="font-bold opacity-75">Looking for Instagram account</h2>
                        </div>
                        <div class="text-gray-100">
                            <p class="opacity-40">Looking for Instagram account with at least 10k followers and...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <div class="bg-black/40 flex flex-col gap-4 rounded-lg p-4 mt-2">
                <h1 class="text-white text-xl">Recent Posts</h1>
                <Post
                    v-for="post in recentPosts"
                    :trade-action="post.tradeAction"
                    :key="post.title"
                    :avatar="post.avatar"
                    :title="post.title"
                    :id="post.id"
                    :description="post.description"
                    :user_id="post.user_id"/>
            </div>
        </div>
    </div>
        <Footer/>
</template>
