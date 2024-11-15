<script setup lang="ts">

import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Services"/>
    <Navigation/>
    <div class="min-h-screen flex justify-center items-center">
    <section class="max-w-5xl mx-auto p-6 bg-black/40 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4 text-white">Our Services</h2>
        <p class="text-white mb-6">
            At our forum, we provide a range of services designed to enhance your experience and meet your needs:
        </p>
        <ul class="list-disc list-inside space-y-4 text-white">
            <li>
                <strong>Discussion Forums:</strong> Engage in lively conversations on various topics, share insights, and learn from others.
            </li>
            <li>
                <strong>Product Searches:</strong> Easily search for products, including gaming accounts and social media accounts, tailored to your interests.
            </li>
            <li>
                <strong>Community Support:</strong> Connect with fellow users for assistance, advice, and shared experiences.
            </li>
            <li>
                <strong>Marketplace:</strong> A dedicated section for buying and selling accounts and products securely.
            </li>
            <li>
                <strong>Resource Sharing:</strong> Access a wealth of resources, guides, and tips related to gaming and online purchases.
            </li>
        </ul>
    </section>
    </div>
    <Footer/>
</template>

<style scoped>

</style>
