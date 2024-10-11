<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import Separator from "@/Components/Separator.vue";

defineProps<{
    post: PostInterface
}>();
</script>

<template>
    <Navigation/>
    <div class="h-screen">
        <div class="container mx-auto mt-20 p-6 bg-black/40 shadow-md rounded-lg">
            <div class="pb-4">
                <h1 class="text-2xl font-bold text-white">{{post.title}}</h1>
                <p class="text-sm text-gray-400">Posted by User5892 on 10-10-2023</p>
            </div>
            <div class="mb-6">
                <Separator/>
            </div>
            <div class="text-white leading-relaxed mb-6">
                <p>
                    {{post.description}}
                </p>
            </div>

            <div class="flex justify-between items-center text-white text-sm">
                <span>Views: 1200</span>
                <span>Replies: 15</span>
            </div>
        </div>
    </div>
    <Footer/>
</template>

