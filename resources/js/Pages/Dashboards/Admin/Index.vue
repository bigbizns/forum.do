<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import logo from '@/Images/logo1.png';
import {AdminDashUsersInterface} from "@/Types/adminDashUsersInterface";
import {getUsDate} from "@/Helpers/getUsDate";
import user from '@/Images/user.png';

defineProps<{
    users:AdminDashUsersInterface[]
}>();

const UserDefault = user;
</script>

<template>
    <Head title="Admin Dashboard"/>
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img class="size-10" :src="logo" alt="Your Company">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <Link :href="route('admin.dashboard.index')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Dashboard</Link>
                                <Link :href="route('admin.dashboard.index')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Edit Requests</Link>
                                <Link :href="route('admin.dashboard.index')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Delete Requests</Link>
                                <Link :href="route('admin.dashboard.index')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Reports</Link>
                                <Link :href="route('home')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 transition duration-300 hover:text-white">Home Page</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-black/40 shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <ul role="list">
                    <li v-for="user in users" :key="user.id" class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded">
                        <div class="flex min-w-0 gap-x-4">
                            <Link :href="route('user.profile', { id: user.id })">
                                <img
                                    :src="user.avatar ? `/storage/${user.avatar}` : UserDefault"
                                    alt=""
                                    class="size-12 flex-none rounded-full bg-gray-50">
                            </Link>
                            <div class="min-w-0 flex-auto">
                                <Link :href="route('user.profile', { id: user.id })" class="text-sm/6 font-semibold text-white">{{ user.username }}</Link>
                                <p class="mt-1 truncate text-xs/5 text-white">{{ user.email }}</p>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm/6 text-white">Points: {{ user.points }}</p>
                            <p class="mt-1 text-xs/5 text-white">Created at: {{getUsDate(user.created_at)}}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </main>
    </div>

</template>
