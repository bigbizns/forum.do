<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import UserDashBoardNav from "@/Components/UserDashBoardNav.vue";
</script>

<template>
    <Head title="Dashboard Your Post"/>
    <div class="min-h-full">
        <UserDashBoardNav/>

        <header class="bg-black/40 shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <!--Content-->
                Your Posts
            </div>
        </main>
    </div>
</template>
