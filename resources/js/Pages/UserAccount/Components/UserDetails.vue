<script lang="ts" setup>
import user from "@/Images/user.png";
import {UserInterface} from "@/Types/UserInterface";
import {getUsDate} from "@/Helpers/getUsDate";
import report from "@/Images/report-flag.png";
import ReportUser from "@/Pages/UserAccount/Components/ReportUser.vue";
import {ref} from "vue";
import {ReportTypeInterface} from "@/Types/ReportTypeInterface";
import {UserAccountEnum} from "@/Enums/UserAccountEnum";

defineProps<{
    userData: UserInterface,
    reportTypes: ReportTypeInterface[],
}>();

const isReporting = ref<boolean>(false);

const toggleReport = () => {
    isReporting.value = !isReporting.value;
};
</script>

<template>

    <template v-if="isReporting">
        <ReportUser :report-types="reportTypes" @cancel="toggleReport" :username="userData.username" :id="userData.id"/>
    </template>

    <div class="max-w-5xl mx-auto bg-black/40 shadow-md rounded-lg overflow-hidden">
        <div class="relative px-6 py-4">
            <div class="left-6 flex justify-between gap-5 ">
                <div class="flex items-center gap-3">
                    <img :src="userData.avatar ? `/storage/${userData.avatar}` : user" alt="User Avatar" class="w-32 h-32 bg-white rounded-full shadow-md">
                    <div class="flex flex-col gap-3">
                        <div class="flex gap-2">
                        <h2 class="text-2xl text-gray-300 font-bold">{{ userData.username }}</h2>
                            <template v-if="userData.suspended === UserAccountEnum.Suspended">
                                <h2 class="text-l bg-red-600 py-1 px-2 rounded-2xl text-white font-semibold">Banned</h2>
                            </template>
                        </div>
                        <div class="flex gap-3 items-center">
                            <b class="text-gray-500">Member Since: </b> <p class="text-gray-300">{{ getUsDate(userData.created_at) }}</p>
                        </div>
                    </div>
                </div>
                <template v-if="userData.id !== $page.props.auth.user.id && userData.suspended !== UserAccountEnum.Suspended">
                <img :src="report" @click="toggleReport" alt="report" class="w-10 h-10 cursor-pointer" />
                </template>
            </div>
        </div>
    </div>
</template>
