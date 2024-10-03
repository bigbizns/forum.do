<script setup lang="ts">
import Aside from "@/Layouts/Aside.vue";
import ProfileSettings from "@/Pages/Account/SettingsComponents/ProfileSettings.vue";
import ChangePassword from "@/Pages/Account/SettingsComponents/ChangePassword.vue";
import UpdateAvatar from "@/Pages/Account/SettingsComponents/UpdateAvatar.vue";
</script>

<template>
    <div class="flex min-h-screen">

        <Aside/>

        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-6">Account Settings</h1>
            <ProfileSettings/>
            <UpdateAvatar/>
            <ChangePassword/>
        </main>
    </div>
</template>
