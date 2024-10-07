<script lang="ts" setup>
import Aside from "../../Layouts/Aside.vue";
import user from '@/Images/user.png';
import type {UserInterface} from "@/Types/UserInterface";

const props = defineProps<{
    userData: UserInterface
}>();
</script>

<template>
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
                        <h2 class="text-2xl font-bold text-gray-300 mb-1">{{ props.userData.username }}</h2>
                        <p class="text-gray-300 text-sm mb-4">{{ props.userData.email }}</p>

                        <p class="text-gray-300 mb-4">
                            {{ props.userData.description }}
                        </p>

                        <div class="flex flex-col gap-4 text-gray-300">
                            <div class="flex items-center">
                                <p>Joined: <span class="font-semibold text-gray-100">{{ props.userData.created_at }}</span></p>
                            </div>
                            <div class="flex items-center">
                                <p>Points: <span class="font-semibold text-gray-100">{{ props.userData.points }}</span></p>
                            </div>
                            <div class="flex items-center">
                                <p>Posts: <span class="font-semibold text-gray-100">0</span></p>
                            </div>
                            <div class="flex items-center">
                                <p>Comments: <span class="font-semibold text-gray-100">0</span></p>
                            </div>
                            <div class="flex items-center">
                                <p>Likes: <span class="font-semibold text-gray-100">0</span></p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-300 mb-2">Social Links</h3>
                            <div class="flex gap-4">
                                <a href="#" target="_blank" class="text-blue-500 hover:underline">Twitter</a>
                                <a href="#" target="_blank" class="text-blue-500 hover:underline">LinkedIn</a>
                                <a href="#" target="_blank" class="text-blue-500 hover:underline">GitHub</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

</template>
