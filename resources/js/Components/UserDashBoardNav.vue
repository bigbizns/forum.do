<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import logo from "@/Images/logo1.png";
</script>

<template>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img class="size-10" :src="logo" alt="Your Company">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <Link :href="route('dashboard.index')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Dashboard</Link>
                            <Link :href="route('dashboard.index')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Your Posts</Link>
                            <Link :href="route('dashboard.index')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Your Requests</Link>
                            <Link :href="route('home')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Home Page</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
