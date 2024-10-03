<script setup lang="ts">
import Footer from "@/Layouts/Footer.vue";
</script>
<template>
    <div class="container mx-auto w-[90%] mt-8 h-screen">
        <!-- TODO: Finish the header section -->
        <div class="search bg-gray-800 rounded-lg p-4 text-white shadow-lg">
            <div class="search-title mb-4">
                <h2 class="text-15 font-bold">Search Forum</h2>
            </div>
            <div class="search-input">
                <input type="text" placeholder="minecraft accounts" class="bg-gray-700 w-full p-1 placeholder-opacity-25 text-opacity-75 placeholder-white text-white border border-gray-600 rounded focus:outline-none focus:border-blue-400"
                />
            </div>
            <p class="text-sm text-white mt-2 font-bold text-center text-opacity-35">
                Search your games: GTA, PUBG, WoW, COC, etc. Available 3000+ games. We support Xbox, PS, Steam, YouTube, Instagram, currency exchange, and many more.
            </p>
        </div>
        <!-- TODO: Think about the topics-->
        <div class="forum bg-gray-900 mt-5 rounded-lg">
            <div class="forumHeader flex items-center rounded-lg">
                <a href="" class="px-8 py-4 text-opacity text-white rounded text-gray">Gaming Marketplace</a>
                <a href="" class="px-8 py-4 text-opacity text-white rounded text-gray">Discussion Forum</a>
                <a href="" class="px-8 py-4 text-opacity text-white rounded text-gray hover">Other Marketplace</a>
            </div>
        </div>
        <!-- TODO: Finish the forum section-->
        <div class="forum-body bg-gray-700 pt-2">
            <div class="post-body bg-gray-800 rounded-lg">
                <div class="post flex flex-row p-3">
                    <div class="post-icon">
                        <img src="https://imageio.forbes.com/specials-images/imageserve/6170e01f8d7639b95a7f2eeb/Sotheby-s-NFT-Natively-Digital-1-2-sale-Bored-Ape-Yacht-Club--8817-by-Yuga-Labs/0x0.png?format=png&width=960" alt="" class="max-w-12">
                    </div>
                    <div class="post-content mx-5">
                        <div class="post-title text-white">
                            <h2 class="font-bold opacity-75">Selling Minecraft Account</h2>
                        </div>
                        <div class="post-description text-gray-100">
                            <p class="opacity-40">saaar please buy my account</p>
                        </div>
                    </div>
                </div>
                <div class="post flex flex-row p-3">
                    <div class="post-icon">
                        <img src="https://gibbonsgazette.org/wp-content/uploads/2022/04/43YAWLITTZJLZIQTCP2JSS4KSM.jpg" alt="" class="max-w-12">
                    </div>
                    <div class="post-content mx-5">
                        <div class="post-title text-white">
                            <h2 class="font-bold opacity-75">Looking for Instagram account</h2>
                        </div>
                        <div class="post-description text-gray-100">
                            <p class="opacity-40">Looking for Instagram account with at least 10k followers and...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <Footer/>
</template>