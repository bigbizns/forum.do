<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import Separator from "@/Components/Separator.vue";

const currentRoute = route().current();

const isItCurrentUrl = (route: string) => {
    return currentRoute === route;
};
</script>

<template>
    <aside class="w-1/4 bg-gray-200 p-6 drop-shadow-[0_4px_10px_rgba(255,255,255,0.4)] rounded-xl">
        <h2 class="text-lg font-semibold mb-6">Menu</h2>
        <nav class="flex flex-col space-y-3">
            <Link :href="route('home')" class="text-gray-700 font-semibold hover:text-blue-600 transition-colors">Home</Link>
            <Separator/>

            <Link :href="route('account.profile')" :class="{'!text-blue-600': isItCurrentUrl('account.profile')}" class="text-gray-700 hover:text-blue-600 transition-colors">Profile</Link>
            <Link :href="route('account.settings')" :class="{'!text-blue-600': isItCurrentUrl('account.settings')}" class="text-gray-700 hover:text-blue-600 transition-colors">Settings</Link>
        </nav>
    </aside>
</template>
