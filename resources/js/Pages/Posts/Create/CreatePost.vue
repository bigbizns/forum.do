<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
</script>

<template>
    <Navigation/>
    <div class="mt-20 mb-5 max-w-3xl mx-auto p-8 bg-black/40 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-white">Create Post</h2>
        <form class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-white">Title</label>
                <input
                    type="text"
                    id="title"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter your post title"
                />
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <textarea
                    id="description"
                    rows="5"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your post content here..."
                ></textarea>
            </div>

            <div>
                <button
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-md shadow-md transition duration-300 ease-in-out"
                >
                    Post
                </button>
            </div>
        </form>
    </div>
    <Footer/>
</template>
