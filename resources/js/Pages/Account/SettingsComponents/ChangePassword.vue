<script setup lang="ts">

</script>

<template>
    <section class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Change Password</h2>
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="current-password" class="block text-gray-700 font-medium mb-1">Current Password</label>
                <input type="password" id="current-password" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" placeholder="Enter current password">
            </div>

            <div class="flex gap-6">
                <div class="w-1/2">
                    <label for="new-password" class="block text-gray-700 font-medium mb-1">New Password</label>
                    <input type="password" id="new-password" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" placeholder="Enter new password">
                </div>
                <div class="w-1/2">
                    <label for="confirm-password" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                    <input type="password" id="confirm-password" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" placeholder="Confirm new password">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">Update Password</button>
            </div>
        </form>
    </section>
</template>
