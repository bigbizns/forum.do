<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <aside class="w-1/4 bg-gray-100 p-6">
        <h2 class="text-lg font-semibold mb-6">Text</h2>
        <nav class="flex flex-col space-y-3">
            <Link :href="route('account.profile')" class="text-gray-700 hover:text-blue-600 transition-colors">Profile</Link>
            <Link :href="route('account.settings')" class="text-gray-700 hover:text-blue-600 transition-colors">Settings</Link>
        </nav>
    </aside>
</template>
