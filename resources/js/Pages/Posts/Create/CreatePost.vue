<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {Head, useForm} from "@inertiajs/vue3";
import { CategoryInterace } from "@/Types/CategoryInterace";

defineProps<{
    categories: CategoryInterace[],
}>();

const form = useForm({
    title: null,
    category: null,
    description: null,
    pinned: false,
});

const submit = () => {
    form.post(route('post.store'), {onSuccess: () => form.reset('title', 'category', 'pinned', 'description')});
};
</script>

<template>
    <Head title="Create Post"/>
    <Navigation/>
    <div class="mt-20 mb-5 max-w-3xl mx-auto p-8 bg-black/40 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-white">Create Post</h2>
        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-white">Title</label>
                <input
                    v-model="form.title"
                    type="text"
                    id="title"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter your post title"
                />
                <small class="text-red-600 font-semibold">{{ form.errors.title }}</small>
            </div>
            <div class="flex justify-between">
                <div class="w-full max-w-xs">
                    <label for="category" class="block text-sm font-medium text-white mb-2">Select Category</label>
                    <select v-model="form.category" id="category" name="category"
                            class="block w-full p-2.5 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option v-for="category in categories" :value="category.id" :key="category.id">
                            {{ category.title }}
                        </option>
                    </select>
                    <small class="text-red-600 font-semibold">{{ form.errors.category }}</small>
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <textarea
                    v-model="form.description"
                    id="description"
                    rows="5"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your post content here..."
                ></textarea>
                <small class="text-red-600 font-semibold">{{ form.errors.description }}</small>
            </div>
            <div>
                <label class="inline-flex items-center mt-3">
                    <input
                        type="checkbox"
                        v-model="form.pinned"
                        class="form-checkbox h-5 w-5 text-blue-600"
                    />
                    <span class="ml-2 text-white">Pin this post</span>
                </label>
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
