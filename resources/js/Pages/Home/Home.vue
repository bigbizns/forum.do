<script setup lang="ts">
import Footer from "@/Layouts/Footer.vue";
</script>
<template>
    <div class="container mx-auto mt-8 h-screen">
        <!-- TODO: Finish the header section -->
        <div class="search bg-gray-800 rounded-lg p-4 text-blue-700 shadow-lg">
            <div class="search-title mb-4">
                <h2 class="text-15 font-bold">🔍 Search Forum</h2>
            </div>
            <div class="search-input">
                <input type="text" placeholder="Search forum..." class="bg-gray-700 w-full p-1 placeholder-white text-white border border-gray-600 rounded focus:outline-none focus:border-blue-400"
                />
            </div>
            <p class="text-sm text-blue-700 mt-2 font-bold text-center">
                Search your games: GTA, PUBG, WoW, COC, etc. Available 3000+ games. We support Xbox, PS, Steam, YouTube, Instagram, currency exchange, and many more.
            </p>
        </div>
        <div class="forum bg-gray-800 mt-5">
            <div class="forumHeader display-flex">
                <a href="" class="p-2 bg-blue-500 rounded font-bold">hey</a>
            </div>
        </div>
    </div>
        <Footer/>
</template>