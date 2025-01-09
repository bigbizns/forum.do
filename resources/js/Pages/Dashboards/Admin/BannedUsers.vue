<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import AdminDashboardNav from "@/Components/AdminDashboardNav.vue";
import DashboardHeader from "@/Layouts/DashboardHeader.vue";
import {AdminDashUsersInterface} from "@/Types/adminDashUsersInterface";

defineProps<{
   users: AdminDashUsersInterface[]
}>();
</script>

<template>
    <Head title="Admin Dashboard"/>
    <div class="min-h-full">
        <AdminDashboardNav/>

        <DashboardHeader/>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <ul role="list">
                <li v-for="user in users" :key="user.id" class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <Link :href="route('user.profile', { id: user.id })" class="text-sm/6 font-semibold text-white duration-300 transition hover:text-blue-500">{{ user.username }}</Link>
                            <p class="mt-1 truncate text-xs/5 text-white">{{ user.email }}</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
