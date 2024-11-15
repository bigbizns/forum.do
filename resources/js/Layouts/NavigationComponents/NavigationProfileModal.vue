<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import Separator from "@/Components/Separator.vue";
</script>

<template>
    <div
        class="flex flex-col text-white absolute top-8 right-0 bg-black/60 w-40 rounded-lg shadow-lg p-2 border border-gray-600 z-50">
        <Link
            :href="route('account.profile')"
            class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Profile
        </Link>
        <Link
            :href="route('dashboard.index')"
            class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Dashboard
        </Link>
        <template v-if="$page.props.auth.user.is_admin">
            <Link
                :href="route('admin.dashboard.index')"
                class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Admin
                Dashboard
            </Link>
        </template>
        <Separator/>
        <Link
            :href="route('account.settings')"
            class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Settings
        </Link>
        <Link
            :href="route('logout')" method="post"
            class="text-red-500 py-2 hover:text-red-600 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">
            Logout
        </Link>
    </div>
</template>
