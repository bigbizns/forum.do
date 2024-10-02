<script lang="ts" setup>
import Aside from "@/Layouts/Aside.vue";
import user from '@/Images/user.png';
</script>

<template>
    <div class="flex min-h-screen">
        <Aside/>
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-6">Your Profile</h1>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex gap-6">
                    <!-- Avatar Placeholder -->
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                        <img :src="user" alt="User Avatar" class="w-full h-full rounded-full object-cover" />
                    </div>

                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">John Doe</h2>
                        <p class="text-gray-500 text-sm mb-4">john.doe@example.com</p>

                        <p class="text-gray-600 mb-4">
                        Description
                        </p>

                        <div class="flex flex-col gap-4 text-gray-600">
                            <div class="flex items-center">
                                <p>Joined: <span class="font-semibold">Jan 1, 2022</span></p>
                            </div>
                            <div class="flex items-center">
                                <p>Points: <span class="font-semibold">53</span></p>
                            </div>
                            <div class="flex items-center">
                                <p>Posts: <span class="font-semibold">120</span></p>
                            </div>
                            <div class="flex items-center">
                                <p>Topics Started: <span class="font-semibold">15</span></p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Social Links</h3>
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
