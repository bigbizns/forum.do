<script setup lang="ts">

</script>

<template>
    <section class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold mb-4">Update Avatar</h2>
        <div class="flex items-center gap-6">
            <!-- Avatar Placeholder/Preview -->
            <div class="w-24 h-24 relative">
                <img :src="avatarUrl" alt="User Avatar" class="w-full h-full object-cover rounded-full shadow-md">
                <label
                    for="avatarUpload"
                    class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-100 flex items-center justify-center rounded-full transition-opacity cursor-pointer"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                    </svg>
                </label>
                <input type="file" id="avatarUpload" class="hidden" @change="handleFileUpload" accept="image/*">
            </div>
            <div>
                <p class="text-gray-600 mb-4">Click on the image to upload a new avatar.</p>
                <button @click="updateAvatar" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                    Update Avatar
                </button>
            </div>
        </div>
    </section>
</template>
