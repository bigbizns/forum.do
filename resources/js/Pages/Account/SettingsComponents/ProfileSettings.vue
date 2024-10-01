<script lang="ts" setup>

</script>
<template>
    <section class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold mb-4">Profile Settings</h2>

        <div class="flex items-start gap-6">
            <form action="#" method="POST" class="flex-1 space-y-4">
                <div class="flex gap-6">
                    <div class="w-1/2">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" id="name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" placeholder="Enter your name">
                    </div>
                    <div class="w-1/2">
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" id="email" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" placeholder="Enter your email">
                    </div>
                </div>

                <div>
                    <label for="bio" class="block text-gray-700 font-medium mb-1">Bio</label>
                    <textarea id="bio" rows="3" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" placeholder="Tell us a little about yourself"></textarea>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">Save Changes</button>
                </div>
            </form>
        </div>
    </section>
</template>
