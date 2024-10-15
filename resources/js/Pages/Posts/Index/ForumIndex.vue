<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {Head} from "@inertiajs/vue3";
import Post from "@/Components/Post.vue";
</script>

<template>
    <Head title="All posts"/>
    <Navigation/>
    <div class="mt-20 container h-screen mx-auto p-6">
        <div class="bg-black/40 flex flex-col gap-4 rounded-lg p-4 mt-2">
            <h1 class="text-3xl font-bold text-white mb-6">All Forum Posts</h1>
            <Post :user_id="2" description="NEED BOOST" :id="1" avatar="" title="FORTNITE"/>
            <Post :user_id="2" description="SELLING BOOST" :id="1" avatar="" title="CS2"/>
            <Post :user_id="2" description="BUYING ACCOUNT" :id="1" avatar="" title="DOTA2"/>
        </div>
    </div>
    <Footer/>
</template>
