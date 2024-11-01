<script lang="ts" setup>
import Aside from "../../Layouts/Aside.vue";
import user from '@/Images/user.png';
import type {UserInterface} from "@/Types/UserInterface";
import {Head} from "@inertiajs/vue3";
import ProfileStatus from "@/Pages/Account/ProfileComponents/ProfileStatus.vue";
import ProfileLinks from "@/Pages/Account/ProfileComponents/ProfileLinks.vue";

const props = defineProps<{
    userData: UserInterface
}>();
</script>

<template>
    <Head title="Profile"/>
    <div class="flex min-h-screen">
        <Aside/>
        <main class="flex-1 p-6">
            <div class="bg-black/40 p-6 rounded-lg shadow-md">
                <div class="flex gap-6">
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                        <img
                            :src="$page.props.auth.user.avatar ? `/storage/${$page.props.auth.user.avatar}` : user"
                            alt="User Avatar"
                            class="w-full h-full rounded-full object-cover"/>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-300 mb-1">{{ userData.username }}</h2>
                        <p class="text-gray-300 text-sm mb-4">{{ userData.email }}</p>
                        <p class="text-gray-300 mb-4">{{ userData.description }}</p>
                        <ProfileStatus :user-data="props.userData"/>
                        <ProfileLinks/>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
