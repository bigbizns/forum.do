<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div
        class="fixed top-12 w-full z-50 bg-yellow-400 flex justify-center items-center py-3 shadow-lg rounded-md">
        <div class="flex items-center text-gray-900 space-x-2">
            <span class="font-bold">⚠️ Email not verified!</span>
            <span class="text-sm">Please go to</span>
            <Link :href="route('account.settings')"
                  class="text-blue-600 font-semibold text-sm transition duration-300 hover:text-blue-500">
                Settings
            </Link>
            <span class="text-sm">to verify your email.</span>
        </div>
    </div>
</template>
