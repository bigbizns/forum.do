<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
defineProps<{
    title: string,
    description: string,
}>();
</script>

<template>
    <Link :href="route('home')">
        <div class="flex bg-gray-800 shadow-xl hover:bg-gray-700 transition duration-200 cursor-pointer rounded flex-row p-3">
            <div class="mx-5">
                <div class="text-white">
                    <h2 class="font-bold opacity-75">{{ title }}</h2>
                </div>
                <div class="text-gray-100">
                    <p class="opacity-40">{{ description }}</p>
                </div>
            </div>
        </div>
    </Link>
</template>
