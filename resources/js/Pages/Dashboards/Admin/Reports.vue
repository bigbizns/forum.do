<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AdminDashboardNav from "@/Components/AdminDashboardNav.vue";
</script>

<template>
    <Head title="Admin Reports"/>
    <div class="min-h-full">
        <AdminDashboardNav/>
        <header class="bg-black/40 shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                Reports
            </div>
        </main>
    </div>
</template>
