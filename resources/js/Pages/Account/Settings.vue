<script setup lang="ts">
import Aside from "@/Layouts/Aside.vue";
import ProfileSettings from "@/Pages/Account/SettingsComponents/ProfileSettings.vue";
import ChangePassword from "@/Pages/Account/SettingsComponents/ChangePassword.vue";
import UpdateAvatar from "@/Pages/Account/SettingsComponents/UpdateAvatar.vue";
import type {UserInterface} from "@/Types/UserInterface";
import EmailVerification from "@/Pages/Account/SettingsComponents/EmailVerification.vue";
import {Head} from "@inertiajs/vue3";

const props = defineProps<{
    userData: UserInterface
}>();
</script>

<template>
    <Head title="Settings"/>
    <div class="flex min-h-screen">
        <Aside/>
        <main class="flex-1 p-6">
            <template v-if="!props.userData.email_verified_at">
            <EmailVerification/>
            </template>
            <ProfileSettings :user-data="props.userData"/>
            <UpdateAvatar/>
            <ChangePassword/>
        </main>
    </div>
</template>
