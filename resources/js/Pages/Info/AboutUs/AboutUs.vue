<script setup lang="ts">

import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
</script>
<template>
    <Navigation/>
    <div class="min-h-screen flex justify-center items-center">
    <section class="max-w-4xl mx-auto p-6 bg-black/40 shadow-xl rounded-lg">
        <h2 class="text-2xl font-bold mb-4 text-white">About Us</h2>
        <p class="text-white mb-6">
            Welcome to our forum! This project is designed to let you dive into any discussions you want (legal, of course).
            Here, you can search for products you want to buy, such as Steam accounts, CS2 accounts, Dota2 accounts, social media accounts, and many other items.
        </p>
        <ul class="list-disc list-inside space-y-2 text-white">
            <li>Engage in meaningful discussions.</li>
            <li>Discover and search for a variety of products.</li>
            <li>Connect with a community of like-minded individuals.</li>
            <li>Stay informed about the latest trends and products.</li>
        </ul>
    </section>
    </div>
    <Footer/>
</template>
