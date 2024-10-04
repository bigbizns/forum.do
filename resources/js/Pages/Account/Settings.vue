<script setup lang="ts">
import Aside from "@/Layouts/Aside.vue";
import ProfileSettings from "@/Pages/Account/SettingsComponents/ProfileSettings.vue";
import ChangePassword from "@/Pages/Account/SettingsComponents/ChangePassword.vue";
import UpdateAvatar from "@/Pages/Account/SettingsComponents/UpdateAvatar.vue";
import type {UserInterface} from "@/Types/UserInterface";

const props = defineProps<{
    userData: UserInterface
}>();
</script>

<template>
    <div class="flex min-h-screen">
        <Aside/>
        <main class="flex-1 p-6">
            <ProfileSettings :user-data="props.userData"/>
            <UpdateAvatar/>
            <ChangePassword/>
        </main>
    </div>
</template>
