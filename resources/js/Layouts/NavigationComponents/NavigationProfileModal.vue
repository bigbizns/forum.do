<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import Separator from "@/Components/Separator.vue";
</script>

<template>
    <div class="flex flex-col text-black absolute top-8 right-0 bg-white w-40 rounded-lg shadow-lg p-2 border border-gray-200 z-50">
        <Link :href="route('account.profile')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Profile</Link>
        <Link :href="route('account.settings')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Settings</Link>
        <Separator />
        <Link :href="route('logout')" method="post" class="text-red-600 py-2 hover:text-red-400 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Logout</Link>
    </div>
</template>
